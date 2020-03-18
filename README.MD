# GeoQuizzAPP :  Un jeu amusant où tu dois positionner une photo sur la carte de ta ville sans te tromper et plus vite que les autres !

## Services

* 1 service back-office : backoffice_api
* 1 service pour l'application mobile : mobile_api
* 1 service pour l'application web  : webapp_api

## Bases de données

* 1 base de données sql global entre les differents services
* 1 base de données sql commandes

## Applications clientes

* webapp_client : application cliente web en vuejs pour jouer au jeu.
* mobile_client : application cliente mobile en NativeScript pour transfert des photos + geolocalisation.
* backoffice_client : application cliente web pour la gestion du jeu.