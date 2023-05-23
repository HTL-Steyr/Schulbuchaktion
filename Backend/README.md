# Projekt aufsetzen

* Repository clonen
* Checkout auf `backend` Branch
* Leeren `mysql` Ordner im Backend Ordner erstellen
* In Ubuntu auf `Schulbuchaktion/Backend` wechseln
```shell
cd ~/Schulbuchaktion/Backend
```
* docker Container erstellen
```shell
docker compose up --build -d
```
```shell
docker exec -it php_symfony_schoolbooks /bin/bash
```
>(Wenn ein Fehler wegen der Symfony/Runtime kommt dann diesen Befehl ausführen)
>```shell
>composer require symfony/runtime
>```

```shell
php bin/console doctrine:migrations:migrate
```
* Einmal [yes] (enter) drücken

# Testdaten einfügen

* Alles aus der `testData.sql` Datei (Schulbuchaktion/Backend/app/sql) kopieren
* Eine neue Query Console aufmachen
* Reinkopieren
* Links oben auf den Run Knopf klicken
* Alles auswählen
