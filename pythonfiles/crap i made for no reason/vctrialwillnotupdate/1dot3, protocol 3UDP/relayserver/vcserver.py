import socket
import helpers
import cbedata
import time
import os

def fileget(file):
    f = open(file, 'r')
    s = f.read()
    f.close()
    return s

def netsetting(setting):
    global inicfg
    return cbedata.get_offline(inicfg, 'main-networking-'+str(setting), 'val')

inicfg = fileget('config.cbedata')

try:
    UDP_IP = ''
    UDP_PORT = int(netsetting('listento'))
    sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM) 
    sock.bind((UDP_IP, UDP_PORT))
except OSError:
    print('Another entity (external program or another instance of this application) is using port '+str(UDP_PORT)+', unable to initalize this relay.')
    input('<ENTER> to exit.')
    exit()

#initialize connections index
connections = {}

#testsock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
#testsock.bind( ('127.0.0.1', 1711) )

class Connection:
    def __init__(self, ip, port, metadata = {}):
        self.sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        self.ipaddress = ip
        self.portno = int(port)
        self.meta = metadata
        #self.sock.bind( (self.ipaddress,self.portno) )
        print(self.ipaddress,self.portno,':','Opened connection', end=', ')
        self.sock.sendto(b'Request to connect accepted.', (self.ipaddress, self.portno) )
        print('sending back response on ports',netsetting('listento'),self.portno)
        #time.sleep(0.1)
        self.sock.sendto(b'response:ACCEPT', (self.ipaddress, int(netsetting('listento'))) )
    def transmit(self, data):
        self.sock.sendto(data, (self.ipaddress, self.portno) )
        print(self.ipaddress,self.portno,':','Relayed',len(data),'bytes')
    def close(self):
        self.sock.close()
    def info(self):
        print('This connection is tied to',self.ipaddress,'on port',self.portno)
        print('Connection metadata stored in memory: ',self.meta,'\n')
        

fss = helpers.filegeta('ips.txt').split('\n')
for i in fss:
    if i:
        iss = i.split(':')
        print('Creating a connection with',iss,'(from ips.txt)')
        connections[i] = Connection(iss[0], int(iss[1]))
        connections[i].info()
        
print('\nSettings: PORT =',UDP_PORT,', PREDEFINED CONNECTIONS =',len(connections),', SINGLE CHANNEL MODE , NOAUTH')
os.system('title '+str(UDP_PORT)+' Relay')
print('Relay has fully initialized.\n')

while True:
    data, addr = sock.recvfrom(60000) 
    datstr = str(data)
    relay = True
    #print('Incoming packet, first initials: '+str(data[0:10])+'')
    if 'CONNECT' in datstr:
        dats = helpers.debyte(datstr).split(' ')
        connections[dats[3]] = Connection(dats[1], int(dats[2]))
        print('>> CONNECT command issued, opened connection to',dats[1],'port',dats[2],', connection-name:',dats[3])
        relay = False
        connections[dats[3]].info()
    if 'D/C' in datstr:
        dats = helpers.debyte(datstr).split(' ')
        connections[dats[3]].close()
        print('>> DISCONNECT command issued, closing connection: '+dats[3])
        del connections[dats[3]]
        relay = False
    if relay:
        for key in connections:
            connections[key].transmit(data)
            #mtestsock.sendto(data, ('127.0.0.1', 1711) )
