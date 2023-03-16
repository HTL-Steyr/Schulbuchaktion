>* Repository clonen
>* Checkout auf Backend-DataBase
>* Leeren mysql Ordner in Backend Ordner erstellen
>* In Ubuntu cd SchulBuchAKtion/Backend wechseln 
>* docker compose up --build ausführen -> Lange Wartezeit
>* Dann neues Ubuntu Fenster öffnen
>* cd SchulBuchAktion
>* docker exec -it php_symfony_schoolbooks /bin/bash ausführen
>* composer require symfony/runtime ausführen
>* php bin/console doctrine:migrations:migrate ausführen
>* Einmal [yes] (enter) drücken
