import requests as rq
import time as t
import os
toload = ''
stri = ''
names = []
f1 = 1
f2 = 2
pathorigin = []
f = open('.htaloaderpolicy', 'r')
things = f.read()
thing = things.split(';')
f.close()

encoder = thing[0].split('=')
encode = encoder[1]

cpda = thing[1].split('=')
cpd = cpda[1]

if toload == '':
    toload = input('loadfile> ')
    
if 'http://' in toload:
    print('Attempting to retrieve load over HTTP...')
    try:
        newRequest = rq.get(toload, timeout=30)
        stri = newRequest.text
    except:
        print('Exception while retrieving load')
        t.sleep(5)
        exit()
else:
    print('Attempting to load the load locally...')
    f = open(toload, 'r')
    stri = f.read()
    f.close()
    
listofthings = str(stri).split('::')
metadata = listofthings[0]
#print(listofthings)

print('')
print('CMD     ARG')
print('------------------------------')
while f2 <= len(listofthings):
    #print(listofthings[f1])
    #print(listofthings[f2])
    if '#MKDIR#' in listofthings[f2]:
        pathorigin.clear()
        listofthings[f2] = listofthings[f2].replace('\n','')
        parent = os.getcwd()
        pathorigin = str(listofthings[f2]).split('##')
        path = os.path.join(parent, pathorigin[2])
        try:
            os.mkdir(path)
            print('MKDIR ' + path)
        except:
            print('MKDIR Exception while creating directory')
    elif '#CHDIR#' in listofthings[f2]:
        pathorigin.clear()
        listofthings[f2] = listofthings[f2].replace('\n','')
        parent = os.getcwd()
        pathorigin = str(listofthings[f2]).split('##')
        path = os.path.join(parent, pathorigin[2])
        os.chdir(path)
        print('CHDIR '+path)
    elif '#WRITE#' in listofthings[f2]:
        pathorigin.clear()
        pathorigin = str(listofthings[f2]).split('##')
        f = open(listofthings[f1], 'w', encoding=encode)
        pathorigin[2] = pathorigin[2].replace('%c',':')
        pathorigin[2] = pathorigin[2].replace('%d','::')
        pathorigin[2] = pathorigin[2].replace('%h','#')
        pathorigin[2] = pathorigin[2].replace('%j','##')
        f.write(pathorigin[2])
        #print(bytes(pathorigin[2], 'utf-8'))
        f.close()
        names.append(listofthings[f1])
        print('WRITE '+listofthings[f1])
    elif '#DEBUG#' in listofthings[f2]:
        pathorigin = str(listofthings[f2]).split('##')
        print('DEBUG')
    elif '#RMOBJ#' in listofthings[f2]:
        pathorigin = str(listofthings[f2]).split('##')
        try:
            os.remove(pathorigin[2])
            print('RMOBJ '+pathorigin[2])
        except:
            print('RMOBJ Exception while removing file')
    elif '#RMDIR#' in listofthings[f2]:
        pathorigin = str(listofthings[f2]).split('##')
        try:
            os.rmdir(pathorigin[2])
            print('RMDIR '+pathorigin[2])
        except:
            print('RMDIR Exception while removing directory')
    elif '#BLAST#' in listofthings[f2]:
        pathorigin = str(listofthings[f2]).split('##')

        try:
            print('BLAST ->')
            listog = os.listdir(pathorigin[2])
            for i in listog:
                if not os.path.isdir(i):
                    os.remove(i)
                    print('    Removed: '+str(i))
                else:
                    print('    Skipped: '+str(i))
        except:
            print('BLAST Exception while blasting directory')
                
    else:
        print('NOCMD '+listofthings[f1])

    #print(listofthings)
    #print(i)

    f2 = f2+2
    f1 = f1+2
    #t.sleep(0.1)
print('------------------------------')
print('Installation complete, exiting in '+str(cpd)+' seconds')
t.sleep(int(cpd))
exit()
#input()
