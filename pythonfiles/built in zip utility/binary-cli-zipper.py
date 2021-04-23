import os
import base64
import time as t
writeto = input('destiny-file> ')
parent = input('parentdir> ')

f = open('.htaloaderpolicy', 'r')
things = f.read()
thing = things.split(';')
f.close()

encoder = thing[0].split('=')
encode = encoder[1]
cpda = thing[1].split('=')
cpd = cpda[1]

print(encode)
def onexecute(loadfile, stri):
    f = open(loadfile, 'ab')
    f.write(stri)
    f.close()
    return None
    #so if we can't write we can just go here and use a function to write
def nonexecute(loadfile, stri):
    f = open(loadfile, 'a')
    f.write(stri)
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
            f = open(i, 'rb')
            contents = f.read()
            f.close()
            #contents = contents.replace(':', '%c')
            #contents = contents.replace('::', '%d')
            #contents = contents.replace('#', '%h')
            #contents = contents.replace('##', '%j')
            onexecute(loadfile, b'::')
            onexecute(loadfile, bytes(str(i), 'utf-8'))
            onexecute(loadfile, b'::\n')
            onexecute(loadfile, b'##WRITE##\n')
            onexecute(loadfile, base64.b64encode(contents))
            onexecute(loadfile, b'\n##\n\n')
            #onexecute(loadfile, '\n##\n\n')
            print('WRITE: '+str(i))
            #onexecute()
        elif os.path.isdir(parent_dir + '/' + i) and i != '.git':
            print('DIR: '+str(i))
            dirsforlater.append(i)
    for i in dirsforlater:
        nonexecute(loadfile, '::MK::\n')
        nonexecute(loadfile, '##MKDIR##' + parent_dir + '/' + str(i) + '##\n\n')
        nonexecute(loadfile, '::'+'CD'+'::\n')
        nonexecute(loadfile, '##CHDIR##' + parent_dir + '/' + str(i) + '##\n\n')
        print(parent_dir + '/' + i)
        os.chdir(parent_dir + '/' + i)
        look(parent_dir + '/' + i, loadfile, encoder)
        os.chdir(parent_dir)
    #ewrite.close()
        
look(parent, writeto, encode)

print('------------------------------')
print('Zip procedure complete, exiting in '+str(cpd)+' seconds')
t.sleep(int(cpd))
