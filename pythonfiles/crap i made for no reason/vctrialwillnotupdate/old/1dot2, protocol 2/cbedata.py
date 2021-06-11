stri = """  _____           _           _      _____      _                 _                 
 |  __ \         (_)         | |    / ____|    | |               | |                
 | |__) | __ ___  _  ___  ___| |_  | (___   ___| |__   ___   ___ | | __ _  __ _ ___ 
 |  ___/ '__/ _ \| |/ _ \/ __| __|  \___ \ / __| '_ \ / _ \ / _ \| |/ _` |/ _` / __|
 | |   | | | (_) | |  __/ (__| |_   ____) | (__| | | | (_) | (_) | | (_| | (_| \__ \
 |_|   |_|  \___/| |\___|\___|\__| |_____/ \___|_| |_|\___/ \___/|_|\__,_|\__, |___/
                _/ |                                                       __/ |    
               |__/                                                       |___/     

===================================================================

Project Schoolags is a Minecraft recreation of Dr. Martin Luther King Junior Middle School in Germantown, Maryland, as well as the
various other creations as a result (such as videos, websites, etc.).

This recreation has been used to help students returning to the real school navigate the various hallways. Chatbox Engine (which is what this file is formatted for) owes its existence
to Project Schoolags.

For a full list of credits, see this blog post:
https://schoolags.wordpress.com/2021/02/19/the-credits-list.


"I thought that all kids did all day was play Fortnite or Roblox,
not Build a School in Minecraft."
--Mr. Jackson



Minecraft Server hosting Project Schoolags:

IP 127.0.0.1
PORT 42069
===================================================================

#machine readable list
begin CBEDATA

class[main>

class[website> url=https://schoolags.wordpress.com/;]

class[contributors> 
class[Arjun> role==video productions, builder, web hosting (schoolags.wordpress.com);]
class[Maddy> role==video productions;]
class[James> role==builder, lead decoration;]
class[Makayla> role==builder, decoration;]
class[Michael> role==builder, decoration;]
class[Kevin> role==builder, founder, texture pack creator;]
class[Raf> role==builder, decoration;]
class[John> role==builder, decoration;]
class[Kate> role==builder, decoration;]
class[Vickie> role==builder, decoration;]
class[Alex> role==decoration;]
class[Rithvik> role==Bedrock builder;]
class[Charles> role==error checking, this file;]

class[commentors>
class[Aaron> role==commentor;]
class[Anjali D.> role==commentor;]
class[Anjali R.> role==commentor;]
class[Arth> role==commentor;]
class[Emerson> role==commentor;]
class[Iris> role==commentor;]
class[Jason> role==commentor;]
class[Jeremy> role==commentor;]
class[Joanna> role==commentor;]
class[Kaitlyn> role==commentor;]
class[Maya> role==commentor;]
class[May> role==commentor;]
class[Nick> role==commentor;]
class[Parim> role==commentor;]
class[Rithvik> role==commentor;]
class[Sanjay> role==commentor;]
class[Sophia> role==commentor;]
class[Vikki> role==commentor;]
class[Zach> role==commentor;]


#CR = Commisioned Room: A room that a teacher wanted custom made.
class[teachers>
class[Mr. Angueira> subject==Instrumental Music; cr==no;]
class[Ms. Archer> subject==Choral; cr==no;]
class[Mr. Bostic> subject==Math; cr==no;]
class[Ms. Briner> subject==Science; cr==no;]
class[Mr. Dempsey> subject==Humanities Media; cr==yes;]
class[Mrs. Feriano> subject==Media Specialist; cr==no;]
class[Mr. Glodek> subject==Physical Education; cr==no;]
class[Mr. Hider> subject==Science; cr==yes;]
class[Mr. Jackson> subject==US History; cr==yes;]
class[Mr. Kennedy> subject==Physical Education; cr==yes;]
class[Mr. Nagele> subject==Tech and CAD; cr==no;]
class[Mr. Portillo> subject==Spanish; cr==yes;]
class[Mr. Sevilla> subject==Math; cr==yes;]
class[Mrs. Kay> subject==English; cr==no;]
class[Mrs. Ski’> subject==Humanities Media; cr==no;]
class[Ms. Davis> subject==English; cr==no;]
class[Ms. Duke> subject==Staff Development Teacher, Poole. MS.; cr==no;]
class[Ms. Eising> subject==Math; cr==no;]
class[Ms. Engestrom> subject==Physical Education; cr==yes;]
class[Ms. Kopinski> subject==Math; cr==no;]
class[Ms. Spurling> subject==Vice Principal; cr==no;]
"""

#OFFLINE PORTION


#offline interpreter, get-info
def get_offline(st, path, ty):
    pathlist = path.split('-')
    contents = st

    st = st.replace('^>', '{special}1')
    st = st.replace('^;', '{special}2')
    st = st.replace('^==', '{special}3')
    st = st.replace('^[', '{special}4')
    st = st.replace('^]', '{special}5')
    
    offset = 0
    c = 0
    offsets = []
    ok = 1
    
    while c < len(pathlist) - 1:
        i = pathlist[0]
        str(i)
        wtf = 'class['+i
        offset = contents.find(wtf, int(offset), len(contents))
        #print(offset)
    
        pathlist.pop(0)
        #print(pathlist)


    #if the path is invalid, an error will be thrown

    lineafter = contents.find(']',int(offset),len(contents))
    subclass = contents[int(offset):int(lineafter):1]

    subclass_index_st = subclass.find(str(pathlist[0])+'==')
    subclass_index_et = subclass.find(';',subclass_index_st,len(subclass))
    variable_0 = subclass[int(subclass_index_st):int(subclass_index_et):1]

    var1 = variable_0.split('==')
                                      
    if ty == 'cls':
        return(subclass.replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']'))

    if ty == 'var':
        norep = str(var1[0])+'=='+str(var1[1])
        return norep.replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']')

    if ty == 'val':
        return(var1[1].replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']'))

    if ty == 'raw':
        return(contents.replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']'))




#offline interpreter, get-info with object creation
def get_offline_obj(st, path, ty):

    st = st.replace('^>', '{special}1')
    st = st.replace('^;', '{special}2')
    st = st.replace('^==', '{special}3')
    st = st.replace('^[', '{special}4')
    st = st.replace('^]', '{special}5')
    
    pathlist = path.split('-')
    
    contents = st

    
    offset = 0
    c = 0
    offsets = []
    ok = 1
    
    while c < len(pathlist) - 0:
        i = pathlist[c]
        str(i)
        #print(i)
        wtf = 'class['+i
        offset = contents.find(wtf, int(offset), len(contents))
        c = c + 1
        ##print(offset)
    
        #pathlist.pop(0)
        #print(pathlist)


    #if the path is invalid, an error will be thrown

    lineafter = contents.find(']',int(offset),len(contents))
    subclass = contents[int(offset):int(lineafter + 1):1]
    num = len(pathlist) - 2

    offset_after = subclass.find('class['+str(pathlist[c - 1])+'>')
    length = len('class['+str(pathlist[c - 1])+'>')
    new_sub = contents[int(offset + length):lineafter:1]
    print("subclass; "+new_sub)

    if ty == 'raw':
        return new_sub.replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']')

    if ty == 'list-val':
        new_sub = new_sub.replace("\n", "")
        attribe = new_sub.split(';')
        output = []

        for i in range(0, len(attribe) - 1):
            i = attribe[i]
            str(i)
            #i = i.replace(";", "")
            tmpv1 = i.split('==')
            #tmpv1.pop(0)
            #print(tmpv1)
            output.append(tmpv1[1].replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']'))

        return output

    if ty == 'list-key':
        new_sub = new_sub.replace("\n", "")
        attribe = new_sub.split(';')
        output = []

        for i in range(0, len(attribe) - 1):
            i = attribe[i]
            str(i)
            #i = i.replace(";", "")
            tmpv1 = i.split('==')
            #tmpv1.pop(0)
            #print(tmpv1)
            output.append(tmpv1[0].replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']'))

        return output

    if ty == 'dic':
        new_sub = new_sub.replace("\n", "")
        attribe = new_sub.split(';')
        output = {}

        for i in range(0, len(attribe) - 1):
            i = attribe[i]
            str(i)
            #i = i.replace(";", "")
            tmpv1 = i.split('==')
            #tmpv1.pop(0)
            #print(tmpv1)
            output[tmpv1[0].replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']')] = tmpv1[1].replace('{special}1','>').replace('{special}2',';').replace('{special}3','==').replace('{special}4','[').replace('{special}5',']')

        return output

    if ty == 'sbc-list':
        newoff = 0
        for i in pathlist:
            newoff = st.find('class['+str(i), newoff)
        return st[newoff:].split(']')




