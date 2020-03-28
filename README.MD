# GeoQuizzAPP :  Un jeu amusant où tu dois positionner une photo sur la carte de ta ville sans te tromper et plus vite que les autres !

## Services

* 1 service back-office : backoffice_api
* 1 service pour l'application mobile : mobile_api
* 1 service pour l'application web : player_api



## Bases de données

* 1 base de données sql global entre les differents services



##A Lire

* Toutes les fonctionnalités obligatoires et additionnelles sont realisées côté back-end
* Liens des documentations des APIs sur dock.etu sont disponible dans le depôt Arche
* Les Scripts de la base de données sont dans ./backoffice_api/sql



##Documentation des APIs

* backoffice : http://api.backoffice.local:19080/swagger/index.html (veuillez intégrer token aprés le login dans la section Authorize présente en haut à droite de la page)
* mobile : http://api.mobile.local:19180/swagger/index.html (veuillez intégrer token aprés le login dans la section Authorize présente en haut à droite de la page)
* player : http://api.player.local:19280/swagger/index.html



##Installation local

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




