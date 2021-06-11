import os
import cbedata
from helpers import *
os.system('title Command Input')

f = open('config.cbedata','r')
inicfg = f.read()
f.close()
#print('Loaded data from config.cbedata')

def getsetting(setting):
    f = open('config.cbedata','r')
    inicfg = f.read()
    f.close()
    return cbedata.get_offline(inicfg, 'main-generalpreferences-'+str(setting), 'val')

while True:
    x = input('command: ')
    xss = x.split(' ')
    if xss[0] == 'connect':
        f = open('config.cbedata', 'r')
        s = f.read()
        f.close()

        s = s.replace('chatbox=='+getsetting('chatbox'), 'chatbox=='+xss[1])

        f = open('config.cbedata', 'w')
        f.write(s)
        f.close()

        os.system('start pull.py')
        os.system('start push.py')
        
    elif xss[0] == 'disconnect':
        stopgateway()
    else:
        print('Invalid command.')
        
    f = None
    s = None
    del f
    del s
