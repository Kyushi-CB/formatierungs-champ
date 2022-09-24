# Formatierungs Champ

Der "Formatierungs Champ" vereinfacht und automatisiert das Low-Level-Formatieren von Datenträgern.

## Index

1. [Funktionsweise](#funktionsweise)
2. [Features](#features) 
3. [Vorbereitungen](#vorbereitungen)
4. [Deployment](#deployment)
5. [Formatieren](#formatieren)
6. [Lizenz](#lizenz)

## Funktionsweise

Als Formatierungsmethode wird der Secure Erase Command von hdparm benutzt. Ein Secure Erase dauert bei SSDs und NVME SSDs ca. 20 Sekunden bis 1 Minute.
Bei HDDs kann man bei einer Richtgröße von 500GB mit ca. 2-3 Stunden rechnen.

Jetzt müsste man für jeden Datenträger, mit hdparm oder ähnlichen Tools,
zuerst den Status des Datenträgers überprüfen und danach den Secure Erase per Command ausführen.

Das dauert :/

Diese Software automatisiert diesen Prozess und liefert alle relevanten Daten, übersichtlich an ein lokales Web-Frontend.
Wenn die Datenträger erkannt, auf Fehler überprüft und der Formatierungsstatus ausgelesen wurde, kann man mit einem Klick auf den "Formatieren" Button,
den Secure Erase anstoßen.

**In diesem Guide wird Raspbian in der 64bit Version mit GUI als OS benutzt.**
Andere Linux Distributionen wurden nicht getestet, sollten aber auch funktionieren.

**Folgende Sprachen und Programme werden benutzt:**
- hdparm
- Parted
- Apache2
- Chromium
- PHP
- Javascript
- HTML5
- CSS
- GIT
- Bash

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

In diesem Beispiel setze ich die Formatierungsstation auf einem Raspberry Pi 4 Model B auf.

**Es wird benötigt:**
- ein Raspberry Pi 4 oder ein PC mit vergleichbaren oder besseren Spezifikationen
- ein aktives USB-Hub (optional, falls nicht genug USB-Ports vorhanden sind bzw. die Datenträger extra Stromzufuhr brauchen z.B. HDDs, NVMEs)
- diverse Adapter für benötigte Schnittstellen z.B. S-ata -> USB 3.0 oder im Desktopbereich PCI-E Adapterkarten
- ein Display zum anzeigen und steuern der Formatierungsstation
- Maus und Tastatur (Falls ein Touchdisplay verwendet wird, kann auf Maus und Tastatur verzichtet werden)
- Debian, Raspbian oder eine vergleichbare Distribution mit Grafischer Oberfläche
- sudo-root Rechte werden benötigt

## Deployment

Bevor es losgeht, werden wie immer zuerst die Paketquellen aktualisiert.
``` bash
sudo apt update && sudo apt upgrade -y
```

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
./deploy.sh
```
Nachdem das Script durchgelaufen ist, startet sich das System neu und man wird von einem Chromium
im Kioskmode begrüßt, in dem nun der Formatierungs Champ laufen sollte.

#### Wichtig!
Es wurde ein neuer User "kiosk" vom Script angelegt.
Dieser darf nicht gelöscht oder umbenannt werden,
da das backend über diesen User Shell-Commands ausführt.

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
#### Achtung!
Der Formatierungsprozess darf unter keinen Umständen unterbrochen werden, da dies den Datenträger irreparabel beschädigen kann.

Sobald der Formatierungsprozess abgeschlossen ist, sollte sich das Icon grün färben.
Der Datenträger kann jetzt entfernt werden.

### License
[GNU General Public License v.3.0](https://github.com/Kyushi-CB/formatierungs-champ/master/LICENSE.md)
