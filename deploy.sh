#!/bin/bash

# color templates
WHITE="\e[0m"
RED="\e[31m"
GREEN="\e[32m"
LIGHTYELLOW="\e[93m"
LIGHTBLUE="\e[94m"
BOLDRED="\e[1;31m"
BOLDGREEN="\e[1;32m"

# check if executing user is root or has sudo rights 
if [ "$EUID" != 0 ]
  then echo -e "[${BOLDRED}Error${WHITE}] Installation nur als root oder sudo Benutzer möglich!"
  exit
fi

# check if OS is debian bullseye 64bit


echo -e "${LIGHTYELLOW}Formatierungs-Champ Install Script v.1.0.0 for Raspbian64/Debian Bullseye by Jack Höhndorf${WHITE}"
echo "Dieses Install-Script macht aus deinem Gerät eine Formatierungsstation."

# query if installer should proceed
while true
do
	read -p "$(echo -e ${LIGHTBLUE}"Mit der Installation beginnen?"${WHITE}) (Ja/Nein):" yn
	case $yn in 
		[yY][eE][sS]|[jJ][aA]|[yY]|[jJ]) 
			echo "Installation wird gestartet..."
			break
			;;	
		[nN][oO]|[nN][eE][iI][nN]|[nN]) 
			echo "Installer wird beendet..."
			exit
			;;
		*) 
			echo "Bitte antworte mit Ja/Nein | Yes/No"
			;;
	esac
done
# standart apt update/upgrade
echo "Führe Update durch..."
{
apt-get update && apt-get upgrade -y
} > /dev/null

# should the system be used as kiosk?
while true
do
	read -p "$(echo -e ${LIGHTBLUE}"Soll das Gerät als Kiosk eingerichtet werden?"${WHITE}) (Ja/Nein):" yn
	case $yn in 
		[yY][eE][sS]|[jJ][aA]|[yY]|[jJ])
			echo "Installation wird für Kiosk konfiguriert..."
			# check if GUI is LXDE
			# check if user kiosk exist
				# if not: create user kiosk
			# add user kiosk to autostart -> /etc/lightdm/lightdm.conf -> autologin-user=kiosk

			# check if unclutter is installed
				# if not: install unclutter
			# add unclutter to autostart ->  /etc/xdg/lxsession/LXDE/autostart -> @unclutter -idle 1

			# check if chromium is installed
				# if not: install chromium
			# add chromium to autostart -> /etc/xdg/lxsession/LXDE/autostart -> chromium-browser --kiosk http:/127.0.0.1
			# configure chrome startpage to localhost
			break
			;;
		[nN][oO]|[nN][eE][iI][nN]|[nN]) 
			echo "Überspringe..."
			break
			;;
		*) 
			echo "Bitte antworte mit Ja/Nein | Yes/No"
			;;
	esac
done

echo "Es werden nun einige benötigte Programme installiert..."

# check if sudo is installed / install sudo
if [[ $(which sudo) == '' ]];
then
	echo "sudo wird installiert..."
	{
	apt-get install git -y
	} > /dev/null
else
	echo "sudo ist bereits installiert, überspringe..."
fi

# check if Git is installed / install Git	
if [[ $(which git) == '' ]];
then
	echo "Git wird installiert..."
	{
	apt-get install git -y
	} > /dev/null
else
	echo "Git ist bereits installiert, überspringe..."
fi

# check if hdparm is installed / install hdparm
if [[ $(which hdparm) == '' ]];
then
	echo "hdparm wird installiert..."
	{
	apt-get install hdparm -y
	} > /dev/null	
else
	echo "hdparm ist bereits installiert, überspringe..."
fi

# check if parted is installed / install parted
if [[ $(which parted) == '' ]];
then
	echo "Parted wird installiert..."
	{
	apt-get install parted -y
	} > /dev/null	
else
	echo "Parted ist bereits installiert, überspringe..."
fi

# check if apache2 is installed / install apache2
if [[ $(which apache2) == '' ]];
then
	echo "Apache2 wird installiert..."
	{
	apt-get install apache2 -y
	} > /dev/null	
else
	echo "Apache2 ist bereits installiert, überspringe..."
fi

echo "setze Berechtigungen für den Benutzer: www-data..."

# add www-data to sudoers
echo "www-data ALL=(ALL) NOPASSWD: /usr/sbin/hdparm, /usr/sbin/parted, usr/sbin/reboot, /usr/bin/apt" | sudo EDITOR="tee -a" visudo

# add directory "formatierungs-champ" to /var/www/
echo "erstelle Verzeichniss /var/www/formatierungs-champ"
{
rm -R /var/www/formatierungs-champ
mkdir /var/www/formatierungs-champ
} > /dev/null 2>&1

# create apache config
echo "Konfiguriere Apache2..."
touch /etc/apache2/sites-enabled/fs.conf
echo "
<VirtualHost *:80>
 DocumentRoot /var/www/formatierungs-champ
 ErrorLog ${APACHE_LOG_DIR}/error.log
 CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>" >| /etc/apache2/sites-enabled/fs.conf

# init git config
echo "Git init..."
git -C '/var/www/formatierungs-champ' init

# pull repository from github
echo "Holen des Repositorys von https://github.com/Kyushi-CB/formatierungs-champ"
git -C '/var/www/formatierungs-champ' pull https://github.com/Kyushi-CB/formatierungs-champ

