import asyncio
import requests
import chatboxengine
import os
import keyboard

sus = chatboxengine.Session('71.255.240.10:8080')

cb = None
contents = None
ons = None
previous = 0
rr = 5
hot = 'shift+ctrl'

password = ''
uid = '1'
ukey = 'root1234'

async def connectTo(cbn):
    print('Initialize connection...')
    global cb
    global contents
    try:
        del cb
    except NameError:
        pass
    
    cb = chatboxengine.Chatbox(sus.server, cbn)
    os.system('cls')
    print('Initialize connection...')
    print('Getting chatbox...')
    got = cb.get()
    if got == '2':
        print('Unable to get Chatbox')
        return 0
        
    contents = got
    ons = ''
    os.system('cls')
    print('Connection ready.')
    await asyncio.sleep(1)
    os.system('cls')
    print(contents.replace('\\n', '\n'))

def connectTo(cbn):
    print('Initialize connection...')
    global cb
    global contents
    try:
        del cb
    except NameError:
        pass
    
    cb = chatboxengine.Chatbox(sus.server, cbn)
    got = cb.get()
    if got == '2':
        print('Unable to get Chatbox')
        return 0
        
    contents = got
    ons = ''
    print('Connection ready.')
    #print(contents.replace('\\n', '\n'))
    
    
async def getChatbox():
    global cb
    global contents
    global ons
    global previous
    got = cb.get()
    if got == '2' or got == contents:
        return 0
    
    previous = len(contents)
    contents = got
    print(contents[previous:], end='')

def askforMSG():
    global cb
    global hot
    global password
    global uid
    global ukey
    bees = input('> ')
    #print(bees)

    if len(bees) != 0:
        if bees[0] == '/':
            bee = bees.split(' ')
            
            if bee[0] == '/join':
                connectTo(bee[1])
                print('Client: Connected to Chatbox '+bee[1]+'\n\n')
            elif bee[0] == '/exit':
                del cb
                print('Client: No longer connected to any Chatbox')
            elif bee[0] == '/rr':
                global rr
                rr = int(bee[1])
                print('Client: Changed rr to '+bee[1])
            elif bee[0] == '/hks':
                hot = bee[1]
                print('Client: Changed SENDMSG hotkey to: '+bee[1])

        elif bees[0] != '/':
            cb.write(bees)
    
async def main():
    global rr
    global hot
    askforMSG()
    keyboard.add_hotkey(hot, askforMSG)
    
    while True:
        try:
            await getChatbox()
        except:
            pass
        await asyncio.sleep(rr)   
        

asyncio.run(main())
print('d')
