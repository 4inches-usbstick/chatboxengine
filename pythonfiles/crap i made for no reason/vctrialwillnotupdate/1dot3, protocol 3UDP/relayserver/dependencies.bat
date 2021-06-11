@echo OFF
title Installer
echo This will install the following dependencies (through PIP): requests (used in a future protocol)
echo Any key to continue.
pause>NUL
py -m pip install requests
REM py -m pip install audioop
echo Done, any key to exit.
pause>NUL