
#REPLACE YOUR IP HERE with the IP of the desired CBE server 
#REPLACE CORRECTADMINPASSWORD with the admin password of the desired CBE server
#WE NOW USE A ROLLING CODE SYSTEM FOR SAYAS
#REPLACE TOKEN with the Discord Bot Token
#USE '$ help' WHILE BOT IS ONLINE FOR HELP

import discord
import requests as request
import random as random
import time
ip = 'YOUR IP HERE'
global horny_activations
horny_activations = 0
print('CBE')

tokens = []
cor_tokens = []
bot_token = 'TOKEN'
def find_nth(haystack, needle, n):
    start = haystack.find(needle)
    while start >= 0 and n > 1:
        start = haystack.find(needle, start+len(needle))
        n -= 1
    return start



#for sending messages: ip is for the server to connect to, writeto is the Chatbox, msg is the message, name is the name to use in the Chatbox, and encoder is the encoder to use
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
        
   
   
client = discord.Client()

@client.event
async def on_ready():
    print('Ready to go...')
    global curpp
    curpp = random.random()
    print(curpp)

@client.event
async def on_message(message):
    if message.content.startswith('$ send'):
        x = message.content.split(";")
        await message.channel.send("Attempting to send a message...")
        stx = sendmsg(ip, x[1], x[2], '', 'UTF-8')
        
        print("S--------------")
        print(x[1])
        print(x[2])
        print(stx)
        stx = str(stx)
        if stx == '200':
            await message.channel.send(":ballot_box_with_check: Send-Message Command sent.")
        if stx != '200':
            await message.channel.send(":no_entry_sign: Send-Message command failed to send, stopcode: " + stx)
            #await message.channel.send(stx)
            
            
            
    if message.content.startswith('$ open'):
        x = message.content.split(";")
        await message.channel.send("Attempting to open a Chatbox...")
        y = new_cb(x[1], 'l', x[2])
        
        print("OX--------------")
        print(x[1])
        print(x[2])
        y[0] = str(y[0])
        y[1] = str(y[1])
        
        if y[0] == '200':
            await message.channel.send("Open-Chatbox Command sent.")
            #await message.channel.send("Try to join: **" +x[1]+"**")
        if y[0] != '200':
            await message.channel.send(":no_entry_sign: Open-Chatbox command failed to send, stopcode: " + str(y[0]))
            #await message.channel.send(y)
            
        #print(y[0])
        #print(y[1])
            
        if "This is a forbidden" in y[1]:
            await message.channel.send(":no_entry_sign: This Chatbox was assigned a forbidden identifier.")
        elif "in use" in y[1]:
            await message.channel.send(":no_entry_sign: This Chatbox was assigned a pre-used identifier")
        else:
            await message.channel.send(":ballot_box_with_check: Try to join with joincode: **" +x[1]+"** or with URL: ")
            joinurl = 'http://'+ip+'/textengine/sitechats/inchat.php?chatnum='+x[1]+'&explorer=0&namer=&encoderm=UTF-8&refreshrate=5000'
            await message.channel.send(joinurl)
            
            joinurl = 'http://'+ip+'/textengine/sitechats/inchat-div.php?chatnum='+x[1]+'&explorer=0&namer=&encoderm=UTF-8&refreshrate=5000'
            await message.channel.send(joinurl)
           
            newtoken = str(random.randint(-2147483644, 2147483644))
            newchatbox = str(x[1])
            tokens.append(newtoken)
            cor_tokens.append(newchatbox)
            print(newtoken)
            print(newchatbox)
            await message.author.send('Delete key: '+newtoken)
            await message.author.send('Use **$ close;<deletekey>** to close your Chatbox.')
    
    if message.content.startswith('$ inv'):
        x = message.content.split(";")
        print("N---------------")
        print(x[1])
        joinurl = 'http://'+ip+'/textengine/sitechats/inchat.php?chatnum='+x[1]+'&explorer=0&namer=&encoderm=UTF-8&refreshrate=5000'
        tosend = 'Join Chatbox **'+x[1]+'** with iFrame page: '+joinurl
        await message.channel.send(tosend)
        joinurl = 'http://'+ip+'/textengine/sitechats/inchat-div.php?chatnum='+x[1]+'&explorer=0&namer=&encoderm=UTF-8&refreshrate=5000'
        tosend = 'Join Chatbox **'+x[1]+'** with Div page: '+joinurl
        await message.channel.send(tosend)
        
        
    if message.content.startswith('$ help'):
        x = message.content.split(";")
        print("H---------------")
        tosend1 = '**List of commands:** $ send, $ open, $ inv, $ close, $ help, $ cmd. Arguments are separated with semicolons (;). Use $cmd;<commandname> for more help.'
        tosend2 = '**List of return values:** :no_entry_sign: means that there was a forbidden / invalid request. :ballot_box_with_check: means that all was well. If nothing is returned by the bot, the bot is having an internal error. If the stopcode is 2 there is a CBE server outage.'
        tosend3 = ':warning: **WARNING:** Using the Discord bot as a proxy to cirvumvent bans is forbidden.'
        await message.channel.send(tosend1)
        await message.channel.send(tosend2)
    if message.content.startswith('$ poll'):
        ok = 1
        msg = message.content
        str(msg)
        
        offset = find_nth(msg, ';', 2)
        #await message.channel.send(msg[offset:])
        
        if ' ' in msg[offset:len(msg) - 2]:
            await message.channel.send('No whitespaces are allowed within the poll options')
            ok = 0
        
        if ok == 1:
            await message.channel.send('Attempting to open Chatbox... (all other commands will be suspended during this procedure)')
            
            try:
                f = requests.get('http://71.255.240.10:8080/textengine/sitechats/newchat_integration.php?newname=voting-tmp&option=l&rurl=norefer', timeout=15)
            except:
                await message.channel.send(':no_entry_sign: Connection timed out - users will not be able to vote for the poll')
                
            await message.channel.send('POLL: '+z[1])
        
            qty = int(z[2])
            options = []
        
            while qty > 0:
                await message.channel.send(z[qty + 2] + ' - ' + 'http://71.255.240.10:8080/textengine/sitechats/sendmsg_integration.php?write=voting-tmp&msg='+z[qty+2]+'&encoderm=UTF-8&namer=vote-&rurl=norefer')
                options.append(z[qty + 2])
                qty = qty - 1
            
            time.sleep(300)
            await message.channel.send('Polling has closed. Counting results...')
            try:
                f = requests.get('http://71.255.240.10:8080/textengine/sitechats/voting-tmp', timeout=15)
                g = f.text
            
                for i in options:
                    instances = g.count(i)
                    await message.channel.send('Option **'+i+'** got **'+str(instances)+'** votes.')
            except:
                await message.channel.send(':no_entry_sign: Connection timed out')
                
                
        f = requests.get('http://71.255.240.10:8080/textengine/sitechats/terminalprocess.php?cmd=del&params=voting-tmp&pass=lets change the password&key=CORRECtADMINKEY')
        await message.channel.send(f.text)
        
        
    if message.content.startswith('$ cmd'):
        x = message.content.split(";")
        print("M---------------")
        
        if x[1] == '$ send':
            await message.channel.send("send: sends a command to a certain Chatbox. Syntax: **$ send;<chatbox>;<message>**.")
            
        if x[1] == '$ open':
            await message.channel.send("open: creates a new Chatbox. Syntax: **$ open;<new chatbox number>;<allowmed/forbidmed>**.")
            await message.channel.send("After creating a Chatbox, you will be DM'd a delete key. This key can be shared, or not. It's a one time use integer that allows you to close your Chatbox.")

        if x[1] == '$ inv':
            await message.channel.send("inv: sends an invitation to a certain Chatbox. Syntax: **$ inv;<chatbox number>**.")
            
        if x[1] == '$ close':
            await message.channel.send("close: closes a Chatbox after opening it. Syntax: **$ close;<delete key>**.")
            await message.channel.send("After creating a Chatbox, you will be DM'd a delete key. This key can be shared, or not. It's a one time integer that allows you to close your Chatbox.")

        if x[1] == '$ help':
            await message.channel.send("help: displays a list of commands. Syntax: **$ help**.")
            
        if x[1] == '$ cmd':
            await message.channel.send("cmd: displays command-specific help. Syntax: **$ cmd;<command>**.")
            
    if message.content.startswith('$ ping'):
        await message.channel.send('Bot latency: {0}'.format(round(client.latency, 1)))
        try:
            awa = request.get('http://71.255.240.10:8080/textengine/sitechats/sendmsg_integration.php', timeout=15)
            await message.channel.send('CBE server response time: '+str(awa.elapsed))
        except:
            await message.channel.send('CBE server is dead.')
        
    if message.content.startswith('$ close'):
        xz = message.content.split(";")
        
        if xz[1] in tokens:
            indextodelete = tokens.index(xz[1])
            chatboxtodelete = cor_tokens[indextodelete]
            code = send_command(ip, 'del', chatboxtodelete, 'CORRECTADMINPASSWORD')
            if str(code) != '200':
                await message.channel.send(":no_entry_sign: Close-Chatbox command failed to send, stopcode: " + str(code))
            else:
                await message.channel.send(":ballot_box_with_check: Chatbox closed")            
            tokens.pop(indextodelete)
            cor_tokens.pop(indextodelete)
            print("DEL---------------")
            print(indextodelete)
            print(chatboxtodelete)
            print(tokens)
            print(cor_tokens)
        elif xz[1] not in tokens:
            await message.channel.send(":no_entry_sign: Invalid delete key")
            print("DELFAIL------------")
            print(indextodelete)
            print(chatboxtodelete)
            print(tokens)
            print(cor_tokens)
            
    if message.content.startswith('$ sa'):
        x = message.content.split(";")

   
        global curpp
        if float(x[2]) == float(curpp):
            await message.channel.send(x[1])
            curpp = random.random()
            curpp = float(curpp)
            print(curpp)
        elif float(x[2]) != float(curpp):
            await message.channel.send('You are forbidden to send messages as me.')
            curpp = random.random()
            curpp = float(curpp)
            print(curpp)
        
        
        
        
            
            

            
        
      
        



    
client.run(bot_token)