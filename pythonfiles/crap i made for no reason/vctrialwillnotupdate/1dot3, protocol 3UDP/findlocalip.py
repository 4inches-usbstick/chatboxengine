import socket
print("hostname: "+socket.gethostname())
print("ip address: "+socket.gethostbyname(socket.gethostname()))
input('<ENTER> to exit.')