apt update && apt upgrade -y
change hostname to formatierungs-champ
create user kiosk
add user kiosk to autostart -> /etc/lightdm/lightdm.conf -> autologin-user=kiosk
/etc/sudoers // Schreibgeschützt add with command!
www-data ALL=(ALL) NOPASSWD: /usr/sbin/hdparm, /usr/sbin/parted, usr/sbin/reboot, /usr/bin/apt

create apache config /etc/apache2/sites-enabled/fs.conf
<VirtualHost *:80>
    ServerAdmin fsadmin@localhost
	DocumentRoot /var/www/formatierungs-champ
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

apt install unclutter -y
add unclutter to autostart -> /etc/xdg/lxsession/LXDE/autostart -> @unclutter -idle 1
add chromium to autostart -> /etc/xdg/lxsession/LXDE/autostart -> chromium-browser --kiosk http:/127.0.0.1
configure chrome startpage to localhost

mkdir /var/www/formatierungs-champ
git -C '/var/www/formatierungs-champ' init
git -C '/var/www/formatierungs-champ' pull https://github.com/Kyushi-CB/formatierungs-champ

