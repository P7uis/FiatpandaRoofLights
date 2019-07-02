#!/bin/bash
set -x

while :
do

if  grep -xq "0" number.txt
then
    ./stop.sh

elif grep -xq "1" number.txt
then
  ./knightriderstyle.sh

elif grep -xq "2" number.txt
then
  ./inout.sh

elif grep -xq "3" number.txt
then
  ./echohello.sh

fi

done
