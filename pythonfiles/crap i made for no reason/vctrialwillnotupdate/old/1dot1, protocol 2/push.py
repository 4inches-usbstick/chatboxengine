#wave and pyaudio dependencies for audio, requests for POSTING, base64 for encoding/decoding, tkinter for GUI, os for tmp file handling, cbedata for initialization and threading for tkinter mainloop
import wave
import pyaudio
import requests
import base64
import os
import tkinter
import threading
import cbedata
import random
from helpers import *
from tkinter import font
os.system('title cbvc speak')


currentaudio = []
stillgoing = True
startgateway()
keepalive = stillkeepgoing()
token = random.randint(100000000000,999999999999)

f = open('config.cbedata','r')
inicfg = f.read()
f.close()
print('Loaded data from config.cbedata')

f = open('currentusertoken.txt','w')
f.write(str(token))
f.close()

print('Connecting with randomly generated user identifier: '+str(token))
    
def getsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-generalpreferences-'+str(setting), 'val')

def gopost(datas):
    requests.post(getsetting('url'), data=datas)
def recordaudios():
    global currentaudio
    global token
    global stillgoing
    stillgoing = True
    currentaudio = []
    chunk = int(getsetting('chunksizebit')) # Record in chunks of 1024 samples
    sample_format = pyaudio.paInt16  # 16 bits per sample
    channels = int(getsetting('channels'))
    fs = int(getsetting('samplerate'))  # Record at 44100 samples per second
    filename = getsetting('outputfile')

    pp = pyaudio.PyAudio()
    print('==========Transmission==========\nOpened audio stream, ',end='')
    stream = pp.open(format=sample_format,channels=channels,rate=fs,frames_per_buffer=chunk,input=True)

    print('beginning to take audio input...')
    while stillgoing:
        for i in range(0, int(fs / chunk * float(getsetting('packetsizeinseconds')))):
            data = stream.read(chunk)
            currentaudio.append(data)
        wf = wave.open(filename, 'wb')
        wf.setnchannels(channels)
        wf.setsampwidth(pp.get_sample_size(sample_format))
        wf.setframerate(fs)
        wf.writeframes(b''.join(currentaudio))
        wf.close()
        currentaudio = []

        re = open(getsetting('outputfile'),'rb')
        rss = re.read()
        re.close()
        os.unlink(getsetting('outputfile'))
        print('Preparing audio data for HTTP POST... ', end='')
        bb = base64.b64encode(rss)
        print('(sending '+str(len(str(bb)))+' characters to server...)')
        if getsetting('uidukeysystem') == 'YES':
            data = {
            'write': getsetting('chatbox'),
            'msg': str(token)+':'+str(bb).replace("b'","").replace("'","")+';',
            'uid': getsetting('uid'),
            'ukey': getsetting('ukey'),
                }
            print('INFO: UID/UKEY used')
        else:
            data = {
            'write': getsetting('chatbox'),
            'msg': str(token)+':'+str(bb).replace("b'","").replace("'","")+';',
                }
        print('Accessing endpoint: '+getsetting('url'),end=', ')
        threading.Thread(target= lambda: gopost(data), daemon=True).start()
        print(data['msg'][0:100])
        #print('reponse time = '+str(rtext.elapsed.total_seconds())+'s ('+str(rtext.elapsed)+')')
        #if 'Stop: ' in rtext.text or '[err:' in rtext.text:
            #print('WARNING: Serverside error, contents of error: ')
            #print(rtext.text)
        if getsetting('disconnectonerr') == 'YES':
            stopgateway()
        #print(stillgoing)
    
    # Stop and close the stream     
    stream.stop_stream()
    stream.close()
    # Terminate the PortAudio interface
    pp.terminate()
    
    print('Closed audio stream.')
    print('Sending end of segment marker...')
    data['msg'] = str(token)+':%nd;'
    threading.Thread(target= lambda: gopost(data), daemon=True).start()
    print(data['msg'][0:])

    # Save the recorded data as a WAV file

    print('==========End Transmission==========\n')
    return None
    
def recordonesecond(self):
    global currentaudio
    global token
    global stillgoing
    stillgoing = True
    currentaudio = []
    chunk = int(getsetting('chunksizebit')) # Record in chunks of 1024 samples
    sample_format = pyaudio.paInt16  # 16 bits per sample
    channels = 2
    fs = int(getsetting('samplerate'))  # Record at 44100 samples per second
    filename = getsetting('outputfile')

    pp = pyaudio.PyAudio()
    print('==========Transmission==========\nOpened audio stream, ',end='')
    stream = pp.open(format=sample_format,channels=channels,rate=fs,frames_per_buffer=chunk,input=True)

    print('beginning to take audio input...')
    for i in range(0, int(fs / chunk * 0.7)):
        data = stream.read(chunk)
        currentaudio.append(data)
        currentaudio.clear()
        #print(stillgoing)
    
    # Stop and close the stream     
    stream.stop_stream()
    stream.close()
    # Terminate the PortAudio interface
    pp.terminate()
    
    print('Stopped taking audio input.')

    # Save the recorded data as a WAV file
    wf = wave.open(filename, 'wb')
    wf.setnchannels(channels)
    wf.setsampwidth(pp.get_sample_size(sample_format))
    wf.setframerate(fs)
    wf.writeframes(b''.join(currentaudio))
    wf.close()

    re = open(getsetting('outputfile'),'rb')
    rss = re.read()
    re.close()
    os.unlink(getsetting('outputfile'))
    print('Preparing audio data for HTTP POST... ', end='')
    bb = base64.b64encode(rss)
    print('(sending '+str(len(str(bb)))+' characters to server...)')
    if getsetting('uidukeysystem') == 'YES':
        data = {
        'write': getsetting('chatbox'),
        'msg': str(token)+':'+str(bb).replace("b'","").replace("'","")+';',
        'uid': getsetting('uid'),
        'ukey': getsetting('ukey'),
            }
    else:
        data = {
        'write': getsetting('chatbox'),
        'msg': str(token)+':'+str(bb).replace("b'","").replace("'","")+';',
            }
    print('Accessing endpoint: '+getsetting('url'),end=', ')
    rtext = requests.post(getsetting('url'), data=data)
    print('reponse time = '+str(rtext.elapsed.total_seconds())+'s ('+str(rtext.elapsed)+')')
    if 'Stop: ' in rtext.text or '[err:' in rtext.text:
        print('WARNING: Serverside error, contents of error: ')
        print(rtext.text)
    print('==========End Transmission==========\n')
    return bb
def stoprecordaudio(self):
    global stillgoing
    global tx
    tx['text'] = 'Press and hold to speak'
    stillgoing = False

def starthelperfunct(self):
    threading.Thread(target=recordaudios, daemon=True).start()
    global tx
    tx['text'] = 'Release to transmit'
    
#custom class for font that just returns a font object with the correct font
class Csize:
    def __init__(self, size):
        self.obj = font.Font(size=int(size))
        return None
    def recall(self):
        return self.obj

root = tkinter.Tk()
root.minsize(520, 200)
root.title('CBVC 1.1 BETA')

t5 = tkinter.Label(text='Chatbox Voice Call (CBVC) - version 1.1 beta / protocol 2')

if getsetting('uidukeysystem') == 'YES':
    addon = 'CBauth enabled (id:'+getsetting('uid')+')'
else:
    addon = 'CBauth disabled'
info = tkinter.Label(text='Bound to chatbox: '+getsetting('chatbox')+' ('+str(token)+') - '+addon, font=Csize(10).recall())
space = tkinter.Label(text='')
tx = tkinter.Button(root, text='Press and hold to speak', font=Csize(16).recall(), bg='#3a820d', fg='#FFFFFF')
dc = tkinter.Button(root, text='Disconnect', font=Csize(14).recall(), bg='#FF0000', fg='#FFFFFF')

tx.bind('<ButtonPress-1>',starthelperfunct)
tx.bind('<ButtonRelease-1>',stoprecordaudio)
dc['command'] = stopgateway

t5.pack()
info.pack()
space.pack()
tx.pack()
dc.pack()

def checkgateway():
    erer = stillkeepgoing()
    if not erer:
        print(erer)
        exit()
    root.after(2000, checkgateway)
    
checkgateway()
root.mainloop()


