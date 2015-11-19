# Wordpress-installation

Dies ist eine test-installation um mal zu sehen, was so alles geht.

## Installation

1. Dieses Repository clonen ```git clone reponame wordpresstest```
2. in das neu erstellte Verzeichnis wechseln: ```cd wordpresstest```
3. composer ausführen: ```composer install```
4. VM starten: ```vagrant up```
5. Im Browser http://127.0.0.1:8080 aufrufen.
6. Es gibt keinen sechsten Schritt!

## Plugin-Verwaltung

Plugins werden nicht über die Wordpress-eigene Verwaltung geladen, sondern über
composer. Zur Zeit in Planung ist noch ein automatisch installiertes Plugin, das
aus der Wordpress-CLoud installierte Plugins automatisch in die Composer-Verwaltete
Installation überträgt.

## Theme-Verwaltung

Themes werden ebenso nicht über die Wordpress-eigene Verwaltung geladen, sondern
über composer. Das automatische Plugin würde ebenfalls für installierte Plugins
einen Eintrag in der composer.json vornehmen.

Sowohl bei selbst entwickelten Plugins als auch bei Themes muss in der jeweiligen
```composer.json``` folgender Eintrag stehen:

    "require": {
        "composer/installers": "~1.0"
    },
    "type": "wordpress-plugin" /* für plugins */
    "type": "wordpress-theme"  /* für Themes */


Zur Zeit muss für jedes eigen-entwickelte Plugin ein eigener ```repositories```-
Eintrag in der ```composer.json``` gemacht werden, da es zur Zeit keine
Satis-Instanz gibt, die die Verwaltung der eigenen Plugins vereinfachen kann.

Nach installation eines plugins muss entweder über die GUI oder über die ```wp```-CLI
das plugin (oder theme) aktiviert werden.

Datenbankaustausche lasen sich mit der wp-CLI lösen, wobei nur von der Live-Umgebung
auf die Preview oder lokalen Entwickler-Umbegungen transferiert werden darf,
nicht umgekehrt.

In wie weit die Uploads synchronisiert werden müssen, steht für mich noch nicht fest.

