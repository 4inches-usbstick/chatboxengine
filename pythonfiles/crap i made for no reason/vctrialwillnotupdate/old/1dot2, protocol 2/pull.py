import requests
import chatboxengine
import cbedata
import time
import os
import base64
import playsound
import random
import wave
import threading
from helpers import *
current = 0
counter = 0
x = ''
os.system('title cbvc listen')

f = open('config.cbedata','r')
inicfg = f.read()
f.close()

def getsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-generalpreferences-'+str(setting), 'val')


filename = getsetting('inputfile')
    
   
ok = True
inicfg = None
print('version 1.2 new cbedata - protocol 2')
for i in reversed(range(1,5)):
    #print(str(i), end=' ')
    time.sleep(0.1)
startgateway()
def fileget(name):
    f = open(name, 'r')
    c = f.read()
    f.close()
    return str(c)


#print('Connecting in 4 seconds: ',end='')


print('\n')

f = open('config.cbedata','r')
inicfg = f.read()
f.close()
print('Loaded data from config.cbedata')

f = open('currentusertoken.txt','r')
token = f.read()
f.close()
print('Loaded token')

print('\n')
    

#placeholder, will actually play audio later
def play(audio):
    global comeon
    comeon = False
    audio = audio.replace('%nd', '')
    print('Executing an audio packet...')
    global chunk, sample_format, fs, filename, channels
    fss = str(random.randint(0,100000000000000))+'.wav'
    f = open(fss, 'wb')
    f.write(base64.b64decode(bytes(audio, 'ASCII')))
    f.close()
    playsound.playsound(fss)

    #os.unlink(fss)
def setx():
    global x
    ree = requests.get(getsetting('displayendpoint')+'?chatbox='+getsetting('chatbox'))
    x = ree
    return None

#will make HTTP requests later
comeon = True
print('=======Packet GET log for debug=======')
while True:
    ok = True
    if comeon:
        print('Making request: '+str(counter),end=';  ')
        if comeon:
            ree = requests.get(getsetting('displayendpoint')+'?chatbox='+getsetting('chatbox'))
            x = ree.text
    else:
        x = x
    print('Retrieved data with '+str(len(x))+' chars of data in total',end=', response time = '+str(ree.elapsed.total_seconds())+', ')
    print('current index: '+str(current)+', ')
    #the remote chatbox was reset and its time to reset the index
    if 'Stop: ' in x or '[err:' in x:
        ok = False
        print('WARNING: Serverside error, contents of error: ')
        print(x)
        if getsetting('disconnectonerr') == 'YES':
            stopgateway()
    if len(x) < current:
        current = 0
        ok = False
        print('Resetting index...')
    if len(x) == current:
        ok = False
        print('No change to the file was detected...')
    if ok:
        #print(x[current:])
        print('Index before '+str(current),end=', ')
        content = str(x[current:])
        current = len(x)
        print('index after '+str(current))
        if len(content) > 2:
            contentlist = content.split(';')
            print(len(contentlist))
        
        for i in contentlist:
            if len(i) < 4:
                comeon = False
            else:
                comeon = False
                print('Packet: '+str(len(i))+' chars')
                print(i[0:10])
                iss = i.split(':')
                tospeak = ''
                #print(iss)
                #print(iss)
                #print('DATA: '+iss[1if getsetting('selfreflect') == 'YES':
                oklocal = True
                try:
                    if getsetting('selfreflect') == 'NO' and iss[0] == str(token):
                        oklocal = False
                    if iss[1] != '%nd':
                        oklocal = True
                    if iss[1] == '%nd':
                        oklocal = False
                except Exception as eeee:
                    print('Exception: '+eeee)
                    print('Will not be executing this packet')
                    oklocal = False

                try:
                    if oklocal and counter > 0:
                        play(iss[1])
                except Exception as eee:
                    print('Exception while playing a packet: '+eee)
        if len(contentlist) < 1:
            comeon = True
    if not ok:
        comeon = True
        
    print('--')
    counter = counter + 1
    time.sleep(float(getsetting('refreshrate')))
    erer = stillkeepgoing()
    if not erer:
        print(erer)
        exit()
