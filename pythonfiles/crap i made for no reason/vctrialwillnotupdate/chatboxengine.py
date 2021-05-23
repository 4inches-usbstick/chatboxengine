import requests as request

class Session:
    def __init__(self, server, password='', timeout='', uid='', ukey=''):
        self.server = server
        self.password = password
        self.timeout = timeout
        self.uid = uid
        self.ukey = ukey
    
    def sendcmd(self, cmd, params):
        try:
            cmdout = request.get('http://'+self.server+'/textengine/sitechats/terminalprocess.php?cmd='+cmd+'&params='+params+'&pass='+str(self.password), timeout=int(self.timeout))
            return cmdout.status_code
        except:
            return str(2)
            
    def sendcmduid(self, cmd, params):
        try:
            cmdout = request.get('http://'+self.server+'/textengine/sitechats/terminalprocess.php?cmd='+cmd+'&params='+params+'&uid='+str(self.uid)+'&ukey='+str(self.ukey), timeout=int(self.timeout))
            return cmdout.status_code
        except:
            return str(2)
        
        
class Chatbox:
    def __init__(self, server, chatbox, name='', encoder='UTF-8', timeout=15):
        self.server = server
        self.chatbox = chatbox
        self.name = name
        self.encoder = encoder
        self.timeout = timeout
        
    def get(self):
        try:
            f = request.get('http://'+self.server+'/textengine/sitechats/display.php?chatbox='+str(self.chatbox), timeout=int(self.timeout))
            return f.text
        except:
            return str(2)
        
    def make(self, option='l', allowmed='forbidmed'):
        try:
            theuri = 'http://'+self.server+'/textengine/sitechats/newchat_integration.php?newname='+str(self.chatbox)+'&option='+option+'&allowmed='+allowmed+'&rurl=norefer'
            output = request.get(theuri, timeout=int(self.timeout))
            return str(output.status_code)
        except:
            return str(2)
            
    def write(self, contents, newline=1, uid='', ukey=''):
        if newline == 1:
            try:
                base_send_get = 'http://' +self.server+ '/textengine/sitechats/sendmsg_integration.php?'
                send = request.get(base_send_get + 'msg=' + str(contents) + '&write=' + str(self.chatbox) + '&rurl=norefer&namer=' + str(self.name) + '&encode=' + self.encoder + '&uid='+str(uid) + '&ukey=' + str(ukey), timeout=int(self.timeout))
                #print(base_send_get + "msg=" + msg + "&write=" + writeto + "&rurl=norefer&namer=" + name + "&encode=" + encoder)
                return str(send.status_code)
            except:
                return str(2)
        elif newline == 0:
            try:
                base_send_get = 'http://' +self.server+ '/textengine/sitechats/sendmsg_integration_nobreak.php?'
                send = request.get(base_send_get + 'msg=' + str(contents) + '&write=' + str(self.chatbox) + '&rurl=norefer&namer=' + str(self.name) + '&encode=' + self.encoder + '&uid='+str(uid) + '&ukey=' + str(ukey), timeout=int(self.timeout))
                #print(base_send_get + "msg=" + msg + "&write=" + writeto + "&rurl=norefer&namer=" + name + "&encode=" + encoder)
                return str(send.status_code)
            except:
                return str(2)
        else:
            return str(2)
            
    def wipe(self, password):
        try:
            addon = '&o=x'
            if '::' in password:
                stuff = password.split('::')
                addon = '&uid='+str(stuff[0])+'&ukey='+str(stuff[1])
            wiper = request.get('http://'+self.server+'/textengine/sitechats/terminalprocess.php?cmd=wipe&params='+str(self.chatbox)+'&param='+str(self.chatbox)+'&pass='+str(password)+'&key='+str(password)+str(addon), timeout=int(self.timeout))
            return str(wiper.status_code)
        except:
            return str(2)

    def delete(self, password):
        try:
            addon = '&o=x'
            if '::' in password:
                stuff = password.split('::')
                addon = '&uid='+str(stuff[0])+'&ukey='+str(stuff[1])
            wiper = request.get('http://'+self.server+'/textengine/sitechats/terminalprocess.php?cmd=del&params='+str(self.chatbox)+'&param='+str(self.chatbox)+'&pass='+str(password)+'&key='+str(password)+str(addon), timeout=int(self.timeout))
            return str(wiper.status_code)
        except:
            return str(2)
            
    def delete_html(self, password):
        try:
            addon = '&o=x'
            if '::' in password:
                stuff = password.split('::')
                addon = '&uid='+str(stuff[0])+'&ukey='+str(stuff[1])
            wiper = request.get('http://'+self.server+'/textengine/sitechats/terminalprocess.php?cmd=delhtml&params='+str(self.chatbox)+'&param='+str(self.chatbox)+'&pass='+str(password)+'&key='+str(password)+str(addon), timeout=int(self.timeout))
            return str(wiper.status_code)
        except:
            return str(2)
    
    def edit(self, find, replace, password):
        try:
            addon = '&o=x'
            if '::' in password:
                stuff = password.split('::')
                addon = '&uid='+str(stuff[0])+'&ukey='+str(stuff[1])
            editout = request.get('http://'+self.server+'/textengine/sitechats/adminedits.php?cb='+str(self.chatbox)+'&gro='+find+'&rw='+replace+'&key='+password+str(addon), timeout=int(self.timeout))
            return str(editout.status_code)
        except:
            return str(2)
            
class HS_Chatbox:
    def __init__(self, server, chatbox, password='', encoder='UTF-8', timeout=15):
        self.server = server
        self.chatbox = chatbox
        self.pas = password
        self.encoder = encoder
        self.timeout = timeout
        
    def get(self):
        try:
            f = request.get('http://'+self.server+'/textengine/sitechats/high-security/display.php?path=.hta'+str(self.chatbox)+'&pass='+str(self.pas), timeout=int(self.timeout))
            return f.text
        except:
            return str(2)
        
    def make(self):
        if len(str(self.pas)) != 16:
            return str(2)
        try:
            theuri = 'http://'+self.server+'/textengine/sitechats/high-security/newchat_integration.php?newname='+str(self.chatbox)+'&newpass='+str(self.pas)+'&rurl=norefer'
            output = request.get(theuri, timeout=int(self.timeout))
            return str(output.status_code)
        except:
            return str(2)
            
    def write(self, contents, newline=1):
        if newline == 1:
            try:
                base_send_get = 'http://' +self.server+ '/textengine/sitechats/high-security/sendmsg_integration.php?'
                send = request.get(base_send_get + 'msg=' + str(contents) + '&write=.hta' + str(self.chatbox) + '&rurl=norefer&pass=' + str(self.pas)+ '&encode=' + self.encoder, timeout=int(self.timeout))
                #print(base_send_get + "msg=" + msg + "&write=" + writeto + "&rurl=norefer&namer=" + name + "&encode=" + encoder)
                return str(send.status_code)
            except:
                return str(2)
    
    def delete(self):
        try:
            wiper = request.get('http://'+self.server+'/textengine/sitechats/high-security/eraser.php?cmd=del&params='+str(self.chatbox)+'&param='+str(self.chatbox)+'&pass='+str(self.pas)+'&key='+str(self.pas), timeout=int(self.timeout))
            return str(wiper.status_code)
        except:
            return str(2)
            
