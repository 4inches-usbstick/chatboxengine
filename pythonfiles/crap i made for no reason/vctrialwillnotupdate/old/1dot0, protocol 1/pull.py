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
print('Listening ability will activate in 4 seconds (do not speak until you are fully connected)')
for i in reversed(range(1,5)):
    #print(str(i), end=' ')
    time.sleep(1)
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
    print('Executing an audio packet...')
    global chunk, sample_format, fs, filename, channels
    fss = str(random.randint(0,1000))+'.wav'
    f = open(fss, 'wb')
    f.write(base64.b64decode(bytes(audio, 'ASCII')))
    f.close()
    playsound.playsound(fss)

    #os.unlink(fss)

#will make HTTP requests later
print('=======Packet GET log for debug=======')
while True:
    ok = True
    print('Making request: '+str(counter),end=';  ')
    ree = requests.get(getsetting('displayendpoint')+'?chatbox='+getsetting('chatbox'))
    x = ree.text
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
        
        for i in contentlist:
            if len(i) < 4:
                pass
            else:
                iss = i.split(':')
                #print(iss)
                #print('DATA: '+iss[1])
                if getsetting('selfreflect') == 'NO':
                    if len(iss[1]) > 1000 and counter > 0 and iss[0] != str(token) and iss[0] != token:
                        #print(iss[1][0:45])
                        if getsetting('daemonthreadplay') == 'YES':
                            threading.Thread(target=lambda: play(iss[1]), daemon=True).start()
                        else: 
                            play(iss[1])
                if getsetting('selfreflect') == 'YES':
                    if len(iss[1]) > 1000 and counter > 0:
                        #print(iss[1][0:45])
                        if getsetting('daemonthreadplay') == 'YES':
                            threading.Thread(target=lambda: play(iss[1]), daemon=True).start()
                        else: 
                            play(iss[1])
        
    print('--')
    counter = counter + 1
    time.sleep(float(getsetting('refreshrate')))
    erer = stillkeepgoing()
    if not erer:
        print(erer)
        exit()
