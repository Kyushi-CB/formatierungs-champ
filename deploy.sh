#!/bin/bash

# check if executing user is root or has sudo rights 
if [ "$EUID" -ne 0 ]
  then echo "Bitte führe dieses Script als root oder Sudo Benutzer aus!";
  break;;
  echo "Installer wird beendet";
  exit;;
fi

# check if OS is debian bullseye 64bit


echo "Formatierungs-Champ Install Script v.1.0.0 for Raspbian64 / Debian Bullseye by https://github.com/Kyushi-CB/"
echo "Dieses Install-Script macht aus deinem Gerät eine Formatierungsstation."

# query if installer should proceed
read -p "Mit der Installation beginnen? (Ja/Nein)" yn
case $yn in 
	[yYjJYesyesYESJajaJA] ) echo "Installation wird gestartet...";
		break;;
	[nNNonoNONeinneinNEIN] ) echo "Installer wird beendet...";
		exit;;
	* ) echo "Bitte antworte mit Ja oder Nein";;
esac
done

# standart apt update/upgrade
echo "Führe Update durch..."
apt update && apt upgrade -y > /dev/null
echo "done"

# should the system be used as kiosk?
read -p "Soll das Gerät als Kiosk eingerichtet werden? (Ja/Nein)" yn
case $yn in 
	[yYjJYesyesYESJajaJA] ) echo "Installation wird für Kiosk konfiguriert...";
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
	[nNNonoNONeinneinNEIN] ) echo "Überspringe Kioskkonfiguration...";
		break;;
	* ) echo "Bitte antworte mit Ja oder Nein";;
esac
done


# check if git is installed
	# if not: install git

# check if hdparm is installed
	# if not: install hdparm

# check if parted is installed
	# if not: install parted

# check if apache2 is installed
	# if not: install apache2
# add to sudoers: www-data ALL=(ALL) NOPASSWD: /usr/sbin/hdparm, /usr/sbin/parted, usr/sbin/reboot, /usr/bin/apt
# mkdir /var/www/formatierungs-champ
# create apache config /etc/apache2/sites-enabled/fs.conf
	# <VirtualHost *:80>
	# 	DocumentRoot /var/www/formatierungs-champ
	# 	ErrorLog ${APACHE_LOG_DIR}/error.log
	# 	CustomLog ${APACHE_LOG_DIR}/access.log combined
	# </VirtualHost>

# git -C '/var/www/formatierungs-champ' init
# git -C '/var/www/formatierungs-champ' pull https://github.com/Kyushi-CB/formatierungs-champ

