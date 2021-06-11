@echo OFF
title Installer
echo This will install the following dependencies (through PIP): requests, pipwin, pyaudio via pipwin, wave, playsound.
echo Any key to continue.
pause>NUL
py -m pip install requests
py -m pip install pipwin
py -m pipwin install pyaudio
py -m pip install wave
py -m pip install playsound
REM py -m pip install audioop
echo Done, any key to exit.
pause>NUL