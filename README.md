# Formatierungs Champ

Der "Formatierungs Champ" vereinfacht und automatisiert das Low-Level-Formatieren von externen Datenträgern oder Datenträgern mit S-ATA schnittstelle.

## Index

1. [Funktionsweise](#funktionsweise)
2. [Features](#features) 
3. [Vorbereitungen](#vorbereitungen)
4. [Deployment](#deployment)
5. [Deployment mit Script](#deployment-mit-script)
6. [Arbeiten mit dem Formatierungs Champ](#arbeiten-mit-dem-formatierungs-champ)

## Funktionsweise

Als Formatierungsmethode wird der Secure Erase Command von hdparm benutzt. Ein Secure Erase dauert bei SSDs und NVME SSDs ca. 20 Sekunden bis 1 Minute.
Bei HDDs kann man pro Platte (Richtgröße 500GB) ca. mit 2-3 Stunden rechnen.

Jetzt müsste man für jeden Datenträger, mit hdparm oder ähnlichen Tools,
zuerst den Status des Datenträgers überprüfen und danach den Secure Erase per Command ausführen.

Das dauert :/

Diese Software automatisiert diesen Prozess und liefert alle relevanten Daten übersichtlich an ein lokales Web-Frontend.
Wenn die Datenträger erkannt, auf Fehler überprüft und der Formatierungsstatus ausgelesen wurde, kann man mit einem Klick auf den "Formatieren" Button,
den Secure Erase anstoßen.

#### In diesem Guide wird Raspbian in der 64bit Version mit GUI als OS benutzt.
Andere Linux Distributionen wurden nicht getestet sollten aber auch funktionieren.

### Folgende Sprachen und Programme werden benutzt:
- hdparm
- parted
- apache2
- Chromium
- PHP
- Javascript
- HTML5
- CSS
- GIT
- bash

Dreh - und Ankerpunkt ist hier PHP. Im Backend werden alle nötigen Shell-Befehle ausgeführt und die darüber gesammelten Daten aubereitet,
verarbeitet und an das Frontend übergeben.

### Eine Internetverbindung wird nur beim Deployment per Script benötigt und zum Updaten des Repositorys. 

## Features

- Secure Erase von externen und internen Datenträgern mit USB, S-ata, M-Key Schnittstelle (passender Adapter benötigt)
- Secure Erase von NVME Datenträgern (to be implemented)
- automatisiertes Formatieren von mehreren Datenträgern
- Grafisches lokales Webinterface
- 1-click Formatierung
- Responsive Web-Frontend mit Touchunterstützung

## Vorbereitungen

In diesem Beispiel setzte ich die Formatierungsstation auf einem Raspberry Pi 4 Model B auf.

### Es wird benötigt:
- ein Raspberry Pi oder ein PC mit vergleichbaren oder besseren Spezifikationen
- ein aktives USB-Hub (optional, falls nicht genug USB-Ports vorhanden sind bzw. die Datenträger extra Stromzufuhr brauchen z.B. HDDs, NVMEs)
- diverse Adapter für benötigte Schnittstellen z.B. S-ata -> USB 3.0 oder im Desktop bereich PCI-E Adapterkarten
- ein Display zum anzeigen und steuern der Formatierungsstation
- Maus und Tastatur (Falls ein Touchdisplay verwendet wird, kann auf Maus und Tastatur verzichtet werden)
- Debian, Raspbian oder eine vergleichbare Distribution mit Grafischer Oberfläche
- sudo-root Rechte werden benötigt

Desweiteren muss GIT installiert werden wie folgt:
``` bash
sudo apt update && sudo apt ugrade -y
sudo apt install git -y
```


## Deployment

Das Setup kann mit dem [deploy.sh]() durchgeführt werden.

### Wiki - to be created
### License
[GNU General Public License v.3.0](https://github.com/Kyushi-CB/formatierungs-champ/edit/master/LICENSE.md)
