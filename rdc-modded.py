import os as os
import time as tt
cmds = []
contents = ''
cmdlist = ['shell','transfer','uac','msg', 'url']

listento = 'C:/wamp64/www/textengine/sitechats/.htaremotedesktop'
kind= 'offline'
tttl = '15'
hmmm = '71.255.240.10:8080'
peepee = 'null'
rr = '5'
        
        





#kind = input('Offline or online control? (options: offline, online) ')
#listento = input('Listen to? (options: <filepath> OR <chatbox number>) ')
#rr = input('Polling rate? (options: any int) ')

int(rr)

if kind == 'online':
    try:
        import requests
        tttl = input('Request time to live? (options: any int) ')
        hmmm = input('Server to connect to? (options: an IP address or domain name) ')
        peepee = input('Password? (options: string that is the correct password) ')
        tttl = int(tttl)
    except:
        print('Error: requests module not found. Go to https://requests.readthedocs.io/en/master/ for installation instructions. ')
        time.sleep(10)
        exit()


print(' ')



def ovr():
    global listento
    global kind
    global hmmm
    global peepee
    global tttl

    if kind == 'offline':
  
        f = open(str(listento), 'w')
        f.write('')
        f.close()
    
    if kind == 'online':
        f = requests.get('http://'+hmmm+'/textengine/sitechats/terminalprocess.php?cmd=wipe&params='+str(listento)+'&param='+str(listento)+'&pass='+str(peepee)+'&key='+str(peepee), timeout=tttl)
        


    
    
def getc(path, typ, ttl):

    global listento
    global kind
    global hmmm
    global peepee
    global tttl
    
    if typ == 'offline':
        f = open(str(path), 'r')
        contents = f.read()
        f.close()
        #print(contents)
        return contents
    if typ == 'online':
        f = requests.get('http://'+hmmm+'/textengine/sitechats/'+listento, timeout=tttl)
        return f.text
        

ovr()
while True:
    cmd = getc(listento, kind, tttl)
    cmd = cmd.replace('\n', '')
    cmds = cmds.clear()
    cmds = cmd.split(';')



    if cmds[0] == 'shell':
        os.system('cd C:\\Windows\\System32')
        str(cmds[1])
        os.system(cmds[1])
        ovr()
        print('Sent to CMD: "'+str(cmds[1])+'"')
        
    if cmds[0] == 'transfer':
        str(cmds[1])
        #cmd = 'copy "'+cmds[1]+'" "C:\\wamp64\\www\\textengine\\sitechats\\media\\'+listento+'\\uploaded'
        #print('Sent to CMD: '+cmd)
        #os.system(cmd)
        print('The transfer command has been disabled.')
        ovr()
        
    if cmds[0] == 'uac':
    
        if cmds[1] == 'lock':
            str(cmds[1])
            cmd = 'shutdown -l'
            os.system(cmd)
            print('Sent to CMD: '+cmd)
            ovr()           
            

        if cmds[1] == 'shutdown':
            str(cmds[1])
            cmd = 'shutdown -p'
            os.system(cmd)
            print('Sent to CMD: '+cmd) 
            ovr()           
        
        if cmds[1] == 'restart':
            str(cmds[1])
            cmd = 'shutdown -r'
            os.system(cmd)
            print('Sent to CMD: '+cmd)
            ovr()
            
    if cmds[0] == 'msg':
        str(cmds[1])
        os.system('cd C:\\Users\\%USERNAME%\\Downloads')
        os.system('echo @echo OFF > sss.bat')
        #print('echo echo '+cmds[1]+'>>sss.bat')
        os.system('echo echo '+cmds[1]+'>>sss.bat')
        os.system('echo echo:>>sss.bat')
        os.system('echo pause^>nul>>sss.bat')
        os.system('echo exit>>sss.bat')
        os.system('start cmd.exe /c start sss.bat')
        #os.system('del sss.bat')
        print('Messaged: '+cmds[1])
        ovr()
        
    if cmds[0] == 'url':
        str(cmds[1])
        cmd = 'start "" '+cmds[1]
        os.system(cmd)
        print('Opened: '+cmds[1])
        ovr()
        
    if cmds[0] == 'kill':
        exit()
        
    if cmds[0] not in cmdlist:
        ovr()
        
        
           
    tt.sleep(int(rr))
            
            
