
#SETUP
import requests as rq



#OFFLINE PORTION


#offline interpreter, get-info
def get_offline(st, path, ty):
    pathlist = path.split('-')
    contents = st

    
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
        return(subclass)

    if ty == 'var':
        return(str(var1[0])+'=='+str(var1[1]))

    if ty == 'val':
        return(var1[1])

    if ty == 'raw':
        return(contents)




#offline interpreter, get-info with object creation
def get_offline_obj(st, path, ty):

    pathlist = path.split('-')
    
    contents = st

    
    offset = 0
    c = 0
    offsets = []
    ok = 1
    
    while c < len(pathlist) - 1:
        i = pathlist[c]
        str(i)
        wtf = 'class['+i
        offset = contents.find(wtf, int(offset), len(contents))
        c = c + 1
        #print(offset)
    
        #pathlist.pop(0)
        #print(pathlist)


    #if the path is invalid, an error will be thrown

    lineafter = contents.find(']',int(offset),len(contents))
    subclass = contents[int(offset):int(lineafter + 1):1]
    num = len(pathlist) - 2

    offset_after = subclass.find('class['+str(pathlist[c - 1])+'>')
    length = len('class['+str(pathlist[c - 1])+'>')
    new_sub = contents[int(offset + length):lineafter:1]

    if ty == 'raw':
        return new_sub

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
            output.append(tmpv1[1])

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
            output.append(tmpv1[0])

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
            output[tmpv1[0]] = tmpv1[1]

        return output







