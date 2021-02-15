#you need to make an HTTP request to do this, so make sure to get the requests package. if you've already imported it earlier in the script, then comment this line so it doesn't reimport.
import requests as request

#for sending messages: ip is for the server to connect to, writeto is the Chatbox, msg is the message, name is the name to use in the Chatbox, and encoder is the encoder to use
def sendmsg(ip, writeto, msg, name, encoder):
    base_send_get = "http://" +ip+ "/textengine/sitechats/sendmsg_integration.php?"
    send = request.get(base_send_get + "msg=" + msg + "&write=" + writeto + "&rurl=norefer&namer=" + name + "&encode=" + encoder)
    #print(base_send_get + "msg=" + msg + "&write=" + writeto + "&rurl=norefer&namer=" + name + "&encode=" + encoder)
    return send.status_code

#for sending terminal commands: ip is for the server to connect to, command is the command to send, params is the one parameter or argument that goes with CBE commands, and key is the password to send along with the command.
def send_command(ip, command, params, key):
    cmdout = requests.get('http://'+ip+'/textengine/sitechats/terminalprocess.php?cmd='+command+'&params='+params+'&pass='+key)
    return cmdout.status_code
    
#sending edits: ip is for the server to connect to, path is for the Chatbox to look in, find is the string to find in the Chatbox, replace is the string to use in place of the find string, and key is the key to password to send along with the command.
def send_edit(ip, path, find, replace, key):
    editout = requests.get('http://'+ip+'/textengine/sitechats/adminedits.php?cb='+path+'&gro='+find+'&rw='+replace+'&key='+key)
    return editout.status_code
