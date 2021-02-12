import requests as rq
import time as t
import os
toload = '%%replace01'
stri = ''
names = []
f1 = 1
f2 = 2
pathorigin = []

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
    
listofthings = stri.split('::')
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
        pathorigin = str(listofthings[f2]).split('#')
        path = os.path.join(parent, pathorigin[2])
        try:
            os.mkdir(path)
            print('MKDIR ' + path)
        except:
            print('MKDIR: Exception while creating directory')
            t.sleep(5)
    elif '#CHDIR#' in listofthings[f2]:
        pathorigin.clear()
        listofthings[f2] = listofthings[f2].replace('\n','')
        parent = os.getcwd()
        pathorigin = str(listofthings[f2]).split('#')
        path = os.path.join(parent, pathorigin[2])
        os.chdir(path)
        print('CHDIR '+path)
    elif '#WRITE#' in listofthings[f2]:
        pathorigin.clear()
        pathorigin = str(listofthings[f2]).split('#')
        f = open(listofthings[f1], 'w')
        f.write(pathorigin[2])
        f.close()
        names.append(listofthings[f1])
        print('WRITE '+listofthings[f1])
    elif '#DEBUG#' in listofthings[f2]:
        print('DEBUG')
    else:
        print('NOCMD '+listofthings[f1])

    #print(listofthings)
    #print(i)

    f2 = f2+2
    f1 = f1+2
print('------------------------------')
print('Installation complete, exiting in 3s')
t.sleep(3)
exit()
#input()
