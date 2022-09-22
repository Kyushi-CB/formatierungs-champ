# Formatierungs Champ

Der "Formatierungs Champ" vereinfacht und automatisiert das Low-Level-Formatieren von externen Datenträgern oder Datenträgern mit S-ATA schnittstelle.

## Index

1. [Funktionsweise](#funktionsweise)
2. [Features](#features) 
3. [Vorbereitungen](#vorbereitungen)
4. [Deployment mit Image](#deployment-mit-image)
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

#### In diesem Guide wird Ubuntu als OS benutzt. Andere Linux Distributionen wurden nicht getestet.

### Folgende Sprachen und Programme werden benutzt:
- hdparm
- parted
- apache2
- Chromium
- PHP
- Javascript
- HTML5
- CSS
- bash

Dreh - und Ankerpunkt ist hier PHP. Im Backend werden alle nötigen Shell-Befehle ausgeführt und die darüber gesammelten Daten aubereitet,
verarbeitet und an das Frontend übergeben.



### Wiki - to be created
### License
[GNU General Public License v.3.0](https://github.com/Kyushi-CB/formatierungs-champ/edit/master/LICENSE.md)
