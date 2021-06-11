def stillkeepgoing():
    z = filegeta('gateway-keepgo.txt')
    if z == 'YES':
        return True
    else:
        return False
def stopgateway():
    f = open('gateway-keepgo.txt', 'w')
    f.write('NO')
    f.close()
def startgateway():
    f = open('gateway-keepgo.txt', 'w')
    f.write('YES')
    f.close()
def filegeta(name):
    f = open(name, 'r')
    c = f.read()
    f.close()
    return str(c)
def debyte(strs):
    return strs.replace("b'", "").replace("'","")