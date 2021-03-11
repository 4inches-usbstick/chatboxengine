import os
writeto = input('destiny-file>')
parent = input('parentdir>')

f = open('.htaloaderpolicy', 'r')
things = f.read()
thing = things.split(';')
f.close()

encoder = thing[0].split('=')
encode = encoder[1]
print(encode)
def onexecute(loadfile, stri):
    f = open(loadfile, 'a')
    f.write(str(stri))
    f.close()
    return None
    #so if we can't write we can just go here and use a function to write

def look(parent_dir, loadfile, encoder):
    files = os.listdir(parent_dir)
    os.chdir(parent_dir)
    dirsforlater = []
    #ewrite = open(loadfile, 'w')
    print(parent_dir)
    for i in files:
        if not os.path.isdir(parent_dir + '/' + i):
            f = open(i, 'r', encoding=encoder)
            contents = f.read()
            f.close()
            contents = contents.replace(':', '%c')
            contents = contents.replace('::', '%d')
            contents = contents.replace('#', '%h')
            contents = contents.replace('##', '%j')
            onexecute(loadfile, '::'+i+'::\n')
            onexecute(loadfile, '##WRITE##\n')
            onexecute(loadfile, str(contents))
            onexecute(loadfile, '\n##\n\n')
            print('WRITE: '+str(i))
            #onexecute()
        elif os.path.isdir(parent_dir + '/' + i) and i != '.git':
            print('DIR: '+str(i))
            dirsforlater.append(i)
    for i in dirsforlater:
        onexecute(loadfile, '::'+'MK'+'::\n')
        onexecute(loadfile, '##MKDIR##' + parent_dir + '/' + str(i) + '##\n\n')
        onexecute(loadfile, '::'+'CD'+'::\n')
        onexecute(loadfile, '##CHDIR##' + parent_dir + '/' + str(i) + '##\n\n')
        print(parent_dir + '/' + i)
        os.chdir(parent_dir + '/' + i)
        look(parent_dir + '/' + i, loadfile, encoder)
        os.chdir(parent_dir)
    #ewrite.close()
        
look(parent, writeto, encode)
