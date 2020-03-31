# GeoQuizzAPP :  Un jeu amusant où tu dois positionner une photo sur la carte de ta ville sans te tromper et plus vite que les autres !

## Services

* 1 service back-end pour back-office : backoffice_api
* 1 service back-end pour mobile : mobile_api
* 1 service back-end pour player : player_api
* 1 service front-end pour backoffice : backoffice_web
* 1 service front-end pour player : player_web


## Bases de données

* 1 base de données sql global entre les differents services

## A Lire

* Toutes les fonctionnalités obligatoires et additionnelles sont realisées côté back-end.
* Liens des documentations des APIs sur docketu sont disponible dans le dépôt Arche.
* Liens des applications clientes sur docketu sont disponible dans le dépôt Arche.
* Les Scripts de la base de données sont dans ./backoffice_api/sql.
* Instruction d'installation en dessous.

## Documentation des APIs (local)

* backoffice : http://api.backoffice.local:19080/swagger/index.html (veuillez intégrer token aprés le login dans la section Authorize présente en haut à droite de la page)
* mobile : http://api.mobile.local:19180/swagger/index.html (veuillez intégrer token aprés le login dans la section Authorize présente en haut à droite de la page)
* player : http://api.player.local:19280/swagger/index.html

## Applications clientes (local)

* backoffice : http://localhost:19380
* player : http://localhost:19480

## Installation local

```
Cloner le projet : git clone https://github.com/elrhomariyounes/geoquizz.git
```

```
cd geoquizz
```

```
docker-compose up
```
```
Importer les données via phpmyadmin ou le service mysql
```




