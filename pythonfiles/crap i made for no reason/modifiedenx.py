import cbedata as cbe
import textwrap as wap
def dec(intake, keypath):
    incre = int(cbe.get_offline(str(keypath), 'main-meta-increment', 'val'))
    things = wap.wrap(intake, incre)
    toreturn = ''
    print(things)
    for i in things:
        str(i)
        print('Ed: '+i)
        
        if '   ' != i:
            mapto = cbe.get_offline(str(keypath), 'main-mappings-'+i, 'val')    
            str(mapto)
            toreturn = toreturn + str(mapto)
    return toreturn
def enc(intake, keypath):
    chars = list(intake)
    toreturn = ''
    #print(chars)
    for j in chars:
        #print(j)
        #print('main-reversemap-'+j)
        try:
            mapd = cbe.get_offline(str(keypath), 'main-reversemap-'+str(j)+'=', 'val')
            toreturn = toreturn + str(mapd)
        except:
            toreturn = 'could not encode: missing character mapping for character: ' + j
            break      
    return toreturn
def dec_remote(intake, keypath):
    incre = int(cbe.get_online(str(keypath), 'main-meta-increment', 'val'))
    things = wap.wrap(intake, incre)
    toreturn = ''
    for i in things:
        str(i)
        mapto = cbe.get_online(str(keypath), 'main-mappings-'+i, 'val')
        str(mapto)
        toreturn = toreturn + str(mapto)
    return toreturn
def enc_remote(intake, keypath):
    chars = list(intake)
    toreturn = ''
    #print(chars)
    for j in chars:
        #print(j)
        #print('main-reversemap-'+j)
        try:
            mapd = cbe.get_online(str(keypath), 'main-reversemap-'+str(j)+'=', 'val')
            toreturn = toreturn + str(mapd)
        except:
            toreturn = 'could not encode: missing character mapping for character: ' + j
            break
    return toreturn
