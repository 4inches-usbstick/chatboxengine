

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




