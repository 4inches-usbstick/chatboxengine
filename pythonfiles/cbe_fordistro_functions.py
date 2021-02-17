import requests as request
#NOTICE: these functions all return the status code of the HTTP request UNLESS it times out. in that case the number '2' will be returned.
def sendmsg(ip, writeto, msg, name, encoder):
    try:
        base_send_get = "http://" +ip+ "/textengine/sitechats/sendmsg_integration.php?"
        send = request.get(base_send_get + "msg=" + msg + "&write=" + writeto + "&rurl=norefer&namer=" + name + "&encode=" + encoder, timeout=15)
        #print(base_send_get + "msg=" + msg + "&write=" + writeto + "&rurl=norefer&namer=" + name + "&encode=" + encoder)
        return send.status_code
    except:
        return str(2)

#for sending terminal commands: ip is for the server to connect to, command is the command to send, params is the one parameter or argument that goes with CBE commands, and key is the password to send along with the command.
def send_command(ip, command, params, key):
    try:
        cmdout = request.get('http://'+ip+'/textengine/sitechats/terminalprocess.php?cmd='+command+'&params='+params+'&pass='+key, timeout=15)
        return cmdout.status_code
    except:
        return str(2)
    
#sending edits: ip is for the server to connect to, path is for the Chatbox to look in, find is the string to find in the Chatbox, replace is the string to use in place of the find string, and key is the key to password to send along with the command.
def send_edit(ip, path, find, replace, key):
    try:
        editout = request.get('http://'+ip+'/textengine/sitechats/adminedits.php?cb='+path+'&gro='+find+'&rw='+replace+'&key='+key, timeout=15)
        return editout.status_code
    except:
        return str(2)
    
def new_cb(newname, option, allowmed):
    try:
        theuri = 'http://'+ip+'/textengine/sitechats/newchat_integration.php?newname='+newname+'&option='+option+'&allowmed='+allowmed+'&rurl=norefer'
        output = request.get(theuri, timeout=15)
        list1 = []
        list1.append(output.status_code)
        list1.append(output.text)
        return list1
    except:
        list1 = []
        list1.append('2')     
        list1.append('Forbidden')  
        return list1
        
   
