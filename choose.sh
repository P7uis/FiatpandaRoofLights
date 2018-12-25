while :
do
	# show menu
	clear
	echo "---------------------------------"
	echo "	     M A I N - M E N U"
	echo "---------------------------------"
	echo "0. stop"
	echo "1. knigtriderstyle"
	echo "2. inout"
	echo "3. Show network stats"
	echo "4. Exit"
	echo "---------------------------------"
	read -r -p "Enter your choice [0-4] : " c
	# take action
	case $c in
		0) echo "0" > number.txt;;
		1) echo "1" > number.txt;;
		2) echo "2" > number.txt;;
		3) echo "3" > number.txt;;
		4) break;;
		*) Pause "Select between 1 to 5 only"
	esac
done
