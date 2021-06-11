import socket
from helpers import *
import pyaudio
import cbedata
import wave
import os
import audioop

f = open('config.cbedata','r')
inicfg = f.read()
f.close()

def filewrite(file,byte):
    f = open(file, 'wb')
    f.write(byte)
    f.close()
    return None

def getsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-generalpreferences-'+str(setting), 'val')
    
def netsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-networking-'+str(setting), 'val')

def fileget(file):
    f = open(file, 'rb')
    s = f.read()
    f.close()
    return s

chunk = int(getsetting('chunksizebit'))
sample_format = pyaudio.paInt16  # 16 bits per sample
channels = int(getsetting('channels'))
fs = int(getsetting('samplerate'))  # Record at 44100 samples per second
filename = 'tmp4.wav'

UDP_IP = netsetting('remoteserver') #the remote server to push to (in this case, the same computer)
UDP_PORT = int(netsetting('udptalkingport')) #the port that the remote server listens to

print("Starting UDP connection...")
print("Relay server IP address: %s" % UDP_IP)
print("Relay server port no.: %s" % UDP_PORT)
sock = socket.socket(socket.AF_INET,socket.SOCK_DGRAM)

print("Opening audio interface...")
pp = pyaudio.PyAudio()
stream = pp.open(format=sample_format,channels=channels,rate=fs,frames_per_buffer=chunk,input=True)

info = pp.get_host_api_info_by_index(0)
numdevices = info.get('deviceCount')
print('\nLocated these audio inputs, choose one: \n\nID    Device\n---------------------------------------')
for i in range(0, numdevices):
        if (pp.get_device_info_by_host_api_device_index(0, i).get('maxInputChannels')) > 0:
            print(i, " - ", pp.get_device_info_by_host_api_device_index(0, i).get('name'))
print('---------------------------------------\n')
pp.terminate()
pp = pyaudio.PyAudio()
stream = pp.open(format=sample_format,channels=channels,rate=fs,frames_per_buffer=chunk,input=True, input_device_index=int(input('Which mic? ')))

if getsetting('ambience') == 'None':
    print('Finding ambient noise - please stay silent.')
    currentaudio = []
    for i in range(0, int(fs / chunk * float(1.0))):
        data = stream.read(chunk)
        currentaudio.append(data)

    wf = wave.open(filename, 'wb')
    wf.setnchannels(channels)
    wf.setsampwidth(pp.get_sample_size(sample_format))
    wf.setframerate(fs)
    wf.writeframes(b''.join(currentaudio))
    wf.close()
    MESSAGE = fileget(filename)
    ambientrms = audioop.rms(MESSAGE,1)
    print('Ambient power level: '+str(ambientrms))
else:
    ambientrms = int(getsetting('ambience'))
    print('Ambient power level (loaded from config): ',ambientrms)
print('\n')

sock.sendto(bytes('CONNECT '+netsetting('myip')+' '+netsetting('udplistenport')+' '+netsetting('myip')+':'+netsetting('udplistenport'), 'utf-8'), (UDP_IP, UDP_PORT) )
#waiting = True
#while waiting:
 #   s = sock.recvfrom(600)
  #  print(so)

    
while True:
    currentaudio = []
    for i in range(0, int(fs / chunk * float(getsetting('packetsize')))):
        data = stream.read(chunk)
        currentaudio.append(data)

    wf = wave.open(filename, 'wb')
    wf.setnchannels(channels)
    wf.setsampwidth(pp.get_sample_size(sample_format))
    wf.setframerate(fs)
    wf.writeframes(b''.join(currentaudio))
    wf.close()
    MESSAGE = fileget(filename)
    rms = audioop.rms(MESSAGE,1)
    print('Packet audio power: '+str(rms), end=', packet length: '+str(len(MESSAGE))+', ')

    if rms > ambientrms + int(getsetting('rmsthreshold')):
        print('rms threshold exceeded')
        sock.sendto(MESSAGE, (UDP_IP, UDP_PORT))
    else:
        print('within rms limits')
