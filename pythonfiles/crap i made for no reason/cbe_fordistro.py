
ip = "" #
print("Chatbox Engine Python")
print("Close this window specifically to instantly close the program")
print("-----------------------------------------")
currentcode = 0

def setcbn(take):
    global cbn
    cbn = take
    return(0)
    
def setn(take):
    global name
    name = take
    return(0)
    
def setip(take):
    global ip
    ip = take
    return(0)
    
def setrera(take):
    global rera
    rera = take
    return(0)
    
def desini():
    iniwindow.destroy()
    
    
import tkinter as tk
print("Imported GUI package")
     
import requests
print("Imported GET package")

while(True):
    iniwindow = tk.Tk()
    L1 = tk.Label(text="Connect to:")
    E1 = tk.Entry()
  
    L2 = tk.Label(text="Name:")
    E2 = tk.Entry()
    
    L3 = tk.Label(text="Server IP:")
    E3 = tk.Entry()
    
    L4 = tk.Label(text="Refresh rate <ms>:")
    L5 = tk.Label(text="Use NAME::UID::UKEY to use CBauth")
    E4 = tk.Entry()
    
    iniwindow.minsize(350, 250)
   
    
    entton = tk.Button(
    text="Connect",
    width=10,
    height=1,
    bg="green",
    fg="white",
    command = lambda:[setcbn(E1.get()), setn(E2.get()), setip(E3.get()), setrera(E4.get()), desini() ]
    )
    
    outton = tk.Button(
    text="Quit",
    width=5,
    height=1,
    bg="red",
    fg="white",
    command = exit
    )
    
    L3.pack()
    E3.pack()
    L4.pack()
    E4.pack()
    L1.pack()
    E1.pack()
    L2.pack()
    E2.pack()
    L5.pack()
    entton.pack()
    outton.pack()
    E3.insert(tk.END, ip)
    E4.insert(tk.END, 5000)
    iniwindow.title("CBE Python Client")
    iniwindow.mainloop()

    
   
   

    #cbn = input("Chatbox Number > ")
    #name = input("Name in Chatbox > ")
    #rr = input("Refresh Rate (ms) > ")
    #encoder in Python is disabled, it's always on UTF-8 - encoder = input("Encoder > ")
    print("-----------------------------------------")
    
    base_send_get = "http://" +ip+ "/textengine/sitechats/sendmsg_integration_nobreak.php?"
    
    print("Attempting to open " + cbn)
    
  
    
    def pullfromtheserver():
        x = requests.get("http://"+ip+"/textengine/sitechats/" + cbn)
        cbtxt = x.text
        cbrsc = x.status_code
        global currentcode
        currentcode = cbrsc
        return(cbtxt)
        
    
    window = tk.Tk()
    cbtex = pullfromtheserver()   
    #checktheserver()
    
    x1 = requests.get("http://"+ip+"/textengine/sitechats/display.php?chatbox=" + cbn)
    cbrs = x1.status_code
    #cbrs = 404
    
    print("cbn: " + cbn)
    print("name: " + name)
    print("server IP: " + ip)
    print("got: " + "http://"+ip+"/textengine/sitechats/" + cbn)
 
    
    if cbrs == 200:
        print("HTTP Success, response code: ")
        print(cbrs)
    if cbrs != 200:
        print("HTTP Error, reponse code: ")
        print(cbrs)
    print("-----------------------------------------")    

        
    
    
    #window.attributes("-fullscreen", True)
    #ar = "Status: Connecting"
    greeting = tk.Label(text="Chatbox Engine Python")
    
    greeting.pack()
    window.title("CBE Python Client")
    
    
    #top = tk.Frame(window)
    #bottom = tk.Frame(window) 

    #top.pack(side=TOP)
    #bottom.pack(side=BOTTOM)

    
    
    
    
    
    #label = tk.Label(
     #   text= cbtex,
      #  fg="white",
       # bg="black",
        #width=150,
        #height=30
    #)
    #label.pack()
    
    textb = tk.Text(window, height=30, width=125)
    textb.pack(expand=True, fill='both')
    textb.insert(tk.END, cbtex)
    
    textb.tag_configure("center", justify='left')
    
    
    
    text_box = tk.Text(
    width=100,
    height=2
    )
    text_box.pack()
    statt = tk.Label(text="Status: ...")
    statt.pack()

    if cbrs == 200:
        statt.config(text='Status: Ready')
    else:
        statt.config(text='Status: HTTP Failure on loading Chatbox ('+str(cbrs)+')')

    
    
    
    
    #nice line comment
    def deletefun(arg=1):
        global statt
        global cbn
        #print('ddddddd')
        addon = '&o=x'
        uid = False
        if '::' in name:
            things = name.split('::')
            addon = '&uid='+str(things[1])+'&ukey='+str(things[2])
            uid = True
        
        inputt = text_box.get("1.0", tk.END)
        inputt1 = text_box.get("1.0", tk.END)
        inputt1 = inputt1.replace('\n', '')
        inputt1 = inputt1.replace('\r', '')
        inputt1 = inputt1.replace('\\', '')
        inputt1 = inputt1.replace(' ', '')
        if ';;changecb' in inputt1:
            cbn = inputt1.split(';;')[0]
            statt.config(text='Status: Changed Chatbox')
        if not inputt1:
            statt.config(text='Status: Cannot send an empty message')
            text_box.delete("1.0", tk.END)
            return None
        else:
            pass
        inputt = inputt.replace('\n', '')
        inputt = inputt + '\n'
        text_box.delete("1.0", tk.END)
        
        if not uid:
            send = requests.get(base_send_get + "msg=" + inputt + "&write=" + cbn + "&rurl=norefer&namer=" + name + "&encode=")
            print("Debug:")
            print(base_send_get + "msg=" + inputt + "&write=" + cbn + "&rurl=norefer&namer=" + name + "&encode=")
            print(send.status_code)
        if uid:
            send = requests.get(base_send_get + "msg=" + inputt + "&write=" + cbn + "&rurl=norefer&namer=" + things[0] + "&encode=" + addon)
            print("Debug:")
            print(base_send_get + "msg=" + inputt + "&write=" + cbn + "&rurl=norefer&namer=" + things[0] + "&encode=" + addon)
            print(send.status_code)
        
        banned = ['Illegal element', 'Stop:', 'API is locked down', 'This chatbox does not actually exist']
        ok = True
        for i in banned:
            if i in send.text:
                ok = send.text
         
        if ok != True:
            statt.config(text='Status: Failure on sending message (' + ok + ')')
            print('Status: Failure on sending message (Illegal action detected)')
        elif int(send.status_code) == 200:
            statt.config(text='Status: Message sent')
        else:
            statt.config(text='Status: HTTP Failure on sending message ('+str(send.status_code)+')')
        #print(send.text)
        my_mainloop()
        return None
    def endsession():
        window.destroy()
        
    button = tk.Button(
        text="Send",
        width=10,
        height=1,
        bg="green",
        fg="white",
        command = deletefun,
    )
  
    delbutton = tk.Button(
        text="Exit this Chatbox",
        width=15,
        height=1,
        bg="red",
        fg="white",
        command = endsession,
    )




    #statt.insert('1.0', 'here is my\ntext to insert')
    #var.set("Status: Ready")
    
    window.bind('<Return>',deletefun)
    button.pack()
    delbutton.pack()
    
    #b.grid(row=0,column=0, sticky=W)
    #c.grid(row=0,column=1, sticky=W)
    
  
    
    
    
    
    #myscroll = ttk.Scrollbar(window, orient='vertical', command=myentry.xview)
    
    def my_mainloop():
        newtext = pullfromtheserver()
        #print(newtext)
        textb.delete('1.0', tk.END)
        textb.insert(tk.END, newtext)
        textb.see(tk.END)
        window.after(rera, my_mainloop)

        if int(currentcode) == 200:
            statt.config(text='Status: Ready')
        else:
            statt.config(text='Status: HTTP Failure on loading Chatbox ('+str(cbrs)+')')
    
    window.after(1000, my_mainloop)
    window.resizable(height = 1000, width = 1000)
       

    
    window.mainloop()
    
    
