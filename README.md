# Formatierungs Champ

Bei diesem Tool handelt es sich um einen Software Stack aus verschiedenen,
zum Teil Linux eigenen Formatierungs und Partitionierungstools,
welche lokal über den Browser gesteuert werden.

Der "Formatierungs Champ" vereinfacht und automatisiert das Low-Level-Formatieren von Datenträgern.

## Index

- [Formatierungs Champ](#formatierungs-champ)
  - [Index](#index)
  - [Funktionsweise](#funktionsweise)
  - [Features](#features)
  - [Vorbereitungen](#vorbereitungen)
  - [Deployment mit Script](#deployment-mit-script)
    - [Installation als Kiosk](#installation-als-kiosk)
  - [Formatieren](#formatieren)
  - [License](#license)

## Funktionsweise

Als Formatierungsmethode wird der Secure Erase Command von hdparm benutzt. Ein Secure Erase dauert bei SSDs und NVME SSDs ca. 20 Sekunden bis 1 Minute.
Bei HDDs kann man bei einer Richtgröße von 500GB mit ca. 2-3 Stunden rechnen.

Jetzt müsste man für jeden Datenträger, mit hdparm oder ähnlichen Tools,
zuerst den Status des Datenträgers überprüfen und danach den Secure Erase per Command ausführen.

Das dauert :/

Diese Software automatisiert diesen Prozess und liefert alle relevanten Daten, übersichtlich an ein lokales Web-Frontend.
Wenn die Datenträger erkannt, auf Fehler überprüft und der Formatierungsstatus ausgelesen wurde, kann man mit einem Klick auf die "Formatieren" Schaltfläche,
den Secure Erase anstoßen.

**In diesem Guide wird Raspbian in der 64bit Version mit LXDE GUI als OS benutzt.**
... andere Distributionen wurden bisher nicht getestet, sollten aber, solange sie auf Debian basieren, ebenfalls funktionieren.
Da der Formatierungs Champ im Hintergrund mit Linux-Befehlen arbeitet, ist er NICHT mit Windows kompatibel.

**Folgende Sprachen, Programme und Befehle werden benutzt:**
- hdparm
- Parted
- Apache2
- unclutter (nur im Kiosk mode)
- Chromium
- PHP
- Javascript
- HTML5
- CSS
- GIT
- Bash
- sudo
- apt

Dreh -und Angelpunkt ist hier PHP. Im Backend werden alle nötigen Shell-Befehle ausgeführt und die darüber gesammelten Daten aufbereitet,
verarbeitet und an das Frontend übergeben.

**Eine Internetverbindung wird nur beim Deployment per Script benötigt und zum aktualisieren des Repositorys und der Paketquellen.**
**Das Betreiben der Formatierungsstation funktioniert komplett offline.**

## Features

- Secure Erase von externen und internen Datenträgern mit z.B. USB, S-ATA, M-Key etc. Schnittstelle (passender Adapter benötigt)
- Secure Erase von NVME Datenträgern (to be implemented)
- automatisiertes Formatieren von mehreren Datenträgern
- Grafisches lokales Webinterface
- 1-click Formatierung
- Responsive Web-Frontend mit Touchunterstützung

## Vorbereitungen

In diesem Beispiel setze ich die Formatierungsstation auf einem Raspberry Pi 4 Model B - Raspbian 64bit (Debian11 "Bullseye") LXDE-Core GUI, auf.

**Es wird benötigt:**
- ein Raspberry Pi 4 oder ein PC mit vergleichbaren oder besseren Spezifikationen
- ein aktives USB-Hub (optional, falls nicht genug USB-Ports vorhanden sind bzw. die Datenträger extra Stromzufuhr brauchen z.B. HDDs, NVMEs)
- diverse Adapter für benötigte Schnittstellen z.B. S-ata -> USB 3.0 oder im Desktopbereich PCI-E Adapterkarten
- ein Display zum anzeigen und steuern der Formatierungsstation
- Maus und Tastatur (Falls ein Touchdisplay verwendet wird, kann auf Maus und Tastatur verzichtet werden)
- Debian, Raspbian, Ubuntu oder eine vergleichbare Distribution auf Debian Basis, mit Grafischer Oberfläche
- sudo-root Rechte werden benötigt

## Deployment mit Script

Das Setup kann mit dem deploy.sh Script durchgeführt werden.
``` bash
wget https://github.com/Kyushi-CB/formatierungs-champ/master/deploy.sh
````

Bevor das Script benutzt werden kann, muss es noch ausführbar gemacht werden!
``` bash
sudo chmod +x deploy.sh
```

Jetzt kann es ausgeführt werden.
``` bash
sudo ./deploy.sh
```

### Installation als Kiosk

Wenn hier mit Ja gantwortet wird ist folgendes zu beachten:
``` bash
Soll das Gerät als Kiosk eingerichtet werden? (Ja/Nein):
```

Damit die Konfiguration als Kiosk reibungslos funktioniert, muss sichergestellt werden, dass:
- LXDE als GUI verwendet wird

Falls GNOME, KDE oder ein anderes GUI verwendet wird, muss ggf. folgendes händisch angepasst werden:
- der neu erstellte user "Kiosk" muss im autostart der GUI hinterlegt werden
- unclutter muss für die GUI konfiguriert und im autostart der GUI hinterlegt werden

Nachdem das Script durchgelaufen ist, startet sich das System neu.
Die Oberfläche der Formatierungsstation kann nun im Browser unter localhost bzw. http://127.0.0.1 aufgerufen werden.

Wenn das System als Kiosk konfiguriert wurde,
wird man automatisch als user "Kiosk" angemeldet und Chromium startet sich automatisch im Kiosk-Mode

**Wichtig!**
Der "www-data" user, welcher von apache2 und php genutzt wird hat für einige benötigte Befehle sudo Rechte erhalten! 
Es wird davon abgeraten ports, von denen auf den Apache2-Server, zugegriffen werden kann in Internet freizugeben!

## Formatieren
Sobald ein Datenträger erkannt wurde unter /dev/sd* oder /dev/nvme* wird er im Browser angezeigt.
Es werden 3 Informationen vom Datenträger abgefragt:
- Typ z.B. HDD, SSD, NVME
- Modellname
- Formatierungsstatus

Falls einer dieser Werte nicht ausgelesen werden kann, wird an betreffender Stelle N/A angezeigt und das Drive-Icon färbt sich rot.
in diesem Fall kann man von einem Hardwaredefekt ausgehen. Der Datenträger kann in diesem Zustand nicht formatiert werden.

Wenn auf dem Datenträger eine Partitionstabelle erkannt wird, bleibt das Icon weiß und der Formatierungsstatus ändert sich auf "Unformatiert".
Der Formatierungsbutton färbt sich grün. Mit einem klick auf diesen und mit anschließender Bestätigung startet der Formatierungsprozess.
Wie oben erwähnt, kann das bei HDDs mehrere Stunden dauern.
**Achtung!**
Der Formatierungsprozess darf unter keinen Umständen unterbrochen werden, da dies den Datenträger irreparabel beschädigen kann.

Sobald der Formatierungsprozess abgeschlossen ist, sollte sich das Icon grün färben.
Der Datenträger kann jetzt entfernt werden.

## License
[GNU General Public License v.3.0](https://github.com/Kyushi-CB/formatierungs-champ/master/LICENSE.md)
