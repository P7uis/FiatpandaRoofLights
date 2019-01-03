# FiatpandaRoofLights
I am building controlable lights on my fiat panda roof. I use a small mqtt script on some esp8266 01s with relay modules.

[ TO DO LIST ]
- set up rpi0 with pitft 3.5" as webserver and mqtt broker. my initial thought is to build it in the the drivers sunvisor.
- create (webpage) control for the lights and their functions
- add more functions
- make it shoot lazerbeams
- add voice control

[ CURRENT STRUGGLES ]
- I did a fresh apache 2 install with php7.0 to host the simple web interface. The goal is to update a string to a file an       overwrite that with every button. the webchoose script will read that file every time it loops and executes the connected     function part with the mqtt commands.  I cant seem to get php to update to the file as of now. I tried multiple things last   thing I did ist the index.php file. The runthis.sh is located in /home/pi/scripts/rooflights and executed at startup.

[ LATER PROJECTS ]
- led strip side indicators/deco ligts when door opened
- automatic lights


[ IDEAS ]
- control options
  I would like to have web control so I can use a smartphone or RPI
  - php enabled webpage that executes bash scripts
