import socket
import wave
import playsound
import cbedata
import pyaudio
import random
import threading
import os

f = open('config.cbedata','r')
inicfg = f.read()
f.close()

def netsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-networking-'+str(setting), 'val')
    
def getsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-generalpreferences-'+str(setting), 'val')
    
UDP_IP = "" #listen to all UDP traffic on port 1711 (different from the one being used to speak)
UDP_PORT = int(netsetting('udplistenport')) #the port that the server will be pushing to for each member in the vc

print('Clearing packets dir, ')
os.system('cd audio')
os.chdir('audio')
os.system('DEL /F/Q/S *.* > NUL')
print("Starting UDP connection...")
try:
    sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM) 
    sock.bind((UDP_IP, UDP_PORT))
except OSError:
        print('Another entity (either an external program or another instance of this application) is using port '+str(UDP_PORT), ', unable to start.')
        input('<ENTER> to exit.')
        exit()
os.chdir('..')

print("Relay server IP address: %s" % "all traffic.")
print("Relay server port no.: %s" % UDP_PORT)


f = open('config.cbedata','r')
inicfg = f.read()
f.close()

print('')
def getsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-generalpreferences-'+str(setting), 'val')
    
def netsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-networking-'+str(setting), 'val')

def filewrite(file,byte):
    f = open(file, 'wb')
    f.write(byte)
    f.close()
    return None

chunk = int(getsetting('chunksizebit'))
sample_format = pyaudio.paInt16  
channels = int(getsetting('channels'))
fs = int(getsetting('samplerate')) 
 
def play(audio):
    fss = 'audio/'+str(random.randint(0,100000000000000))+'.wav'
    global chunk, sample_format, fs, channels
    f = open(fss, 'wb')
    f.write(audio)
    f.close()
    playsound.playsound(fss)
    #os.unlink(fss)
    

while True:
    data, addr = sock.recvfrom(60000) 
    if getsetting('pullpyverbose') == 'YES':
        print("received packet from "+str(addr)+", len = "+str(len(str(data))))
    if len(data) < 100:
        print('nonaudio packet: '+str(data))
    else:
        try: 
            play(data)
        except Exception as e: 
            if getsetting('pullpyverbose') == 'YES':
                print('An exception occured on audio playback, contents: ',e)
    
