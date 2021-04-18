#change to connect to a different server by default
ip = "example.com"
print("Chatbox Engine Terminal for Python. Type pyterm-help for special help (commands specific to this terminal), and help for CBE commands.")
print("Use UID::UKEY to replace the password with login info.")
print("The default IP is: " + ip)
while True:

    import requests as requests
    import time
       
    def send_command(command, params, key):
        print("-----------------------------------------")
        if '::' not in key:
            print('http://'+ip+'/textengine/sitechats/terminalprocess.php?cmd='+command+'&params='+params+'&pass='+key)
            x1 = requests.get('http://'+ip+'/textengine/sitechats/terminalprocess.php?cmd='+command+'&params='+params+'&pass='+key)
            return x1.text
        elif '::' in key:
            stuff = key.split('::')
            print('http://'+ip+'/textengine/sitechats/terminalprocess.php?cmd='+command+'&params='+params+'&pass='+key+'&uid='+str(stuff[0])+'&ukey='+str(stuff[1]))
            x1 = requests.get('http://'+ip+'/textengine/sitechats/terminalprocess.php?cmd='+command+'&params='+params+'&pass='+key+'&uid='+str(stuff[0])+'&ukey='+str(stuff[1]))
            return x1.text
    
    def send_edit(path, find, replace, key):
        print("-----------------------------------------")
        if '::' not in key:
            print('http://'+ip+'/textengine/sitechats/adminedits.php?cb='+path+'&gro='+find+'&rw='+replace+'&key='+key)
            x1 = requests.get('http://'+ip+'/textengine/sitechats/adminedits.php?cb='+path+'&gro='+find+'&rw='+replace+'&key='+key)
            return x1.text
        elif '::' in key:
            stuff = key.split('::')
            print('http://'+ip+'/textengine/sitechats/adminedits.php?cb='+path+'&gro='+find+'&rw='+replace+'&key='+key+'&uid='+str(stuff[0])+'&ukey='+str(stuff[1]))
            x1 = requests.get('http://'+ip+'/textengine/sitechats/adminedits.php?cb='+path+'&gro='+find+'&rw='+replace+'&key='+key+'&uid='+str(stuff[0])+'&ukey='+str(stuff[1]))
            return x1.text
    
    def send_newcmd(number, allowmed, option):
         theurl = "http://71.255.240.10:8080/textengine/sitechats/newchat_integration.php?newname="+number+"&option="+option+"&allowmed="+allowmed+"&rurl=norefer";
         write = requests.get(theurl)
         return write.text
         
    def new_cb(newname, option, allowmed):
        theuri = 'http://71.255.240.10:8080/textengine/sitechats/newchat_integration.php?newname='+newname+'&option='+option+'&allowmed='+allowmed+'&rurl=norefer'
        output = requests.get(theuri)
        return output.text
   
    commandi = str(input(">>> "))
    paramsi = str(input("> "))
    keyi = str(input("> "))
    #print('http://'+ip+'/textengine/sitechats/terminalprocess.php?cmd='+command+'&params='+params+'&key='+key)
    
    if commandi == "edit":
        replacei = str(input("> "))
        editkey = str(input("> "))
        out = send_edit(paramsi, keyi, replacei, editkey)
        print(out)
        print("-----------------------------------------")
    elif commandi == "send":
        replacei = str(input("> "))
        editkey = str(input("> "))
        print("-----------------------------------------")
        #print("http://"+ip+""msg=" + paramsi + "&write=" + keyi + "&rurl=norefer&namer=" + replacei + "&encoder=")
        out_send = requests.get("http://"+ip+"/textengine/sitechats/sendmsg_integration.php?" + "msg=" + paramsi + "&write=" + keyi + "&rurl=norefer&namer=" + replacei + "&encoder=" + editkey)
        print(out_send.text)
        print("-----------------------------------------")
    elif commandi == "pyterm-help":
        print("Sending regular terminal commands: just enter the command, the parameter, then the key. For edit, enter the edit command, the path, the findstr, the replacewithstr, and the key (all arguments necessary). For the send command, type in the send command, the message, the path, the name, and the encoder. (message and path arguments necessary). You can make a regular GET request with exe-py. Type in the command, then the URL to GET. change-ip to change the IP of the server you want to connect to. This needs to be an IP that is CBE configured. Enter the command, then the IP (with port number). For write, enter the command, the new chatbox number, the allowmed (allowmed/forbidmed) directive, and the new chatbox directive (l|h|d). ")
    elif commandi == "exit":
        exit()
    elif commandi == "change-ip":
        ip = paramsi
        print("The current IP is: " + ip)
    elif commandi == "exe-py":
        boi = requests.get(paramsi)
        print(boi.text)
    if commandi == "write":
        replacei = str(input("> "))
        out = send_newcmd(paramsi, keyi, replacei)
        print(out)
        print("-----------------------------------------")
    else:
        out1 = send_command(commandi, paramsi, keyi)
        print(out1)
        print("-----------------------------------------")
        
       
        
        

