# GeoQuizzAPP :  Un jeu amusant où tu dois positionner une photo sur la carte de ta ville sans te tromper et plus vite que les autres !

## Services

* 1 service back-office : backoffice_api
* 1 service pour l'application mobile : mobile_api
* 1 service pour l'application web : player_api


## Bases de données

* 1 base de données sql global entre les differents services



##Documentation des APIs

* Vous trouverez les liens de la documentation des différentes APIs dans le dépôt Arche



## Applications clientes

* backoffice : application cliente web en VueJs pour la gestion du jeu.
* player : application cliente web en VueJs pour jouer au jeu.
* mobile : application cliente mobile en NativeScript pour transfert des photos + geolocalisation.


##Installation local

```
Cloner le projet
```

```
cd geoquizz
```

```
docker-compose up
```
```
Vous trouverez ci-joint un dossier contenant les differents scripts pour la base de données ainsi que des données fictives
```



##Documentation des APIs Local

* backoffice : http://api.backoffice.local:19080/swagger/index.html (veuillez intégrer token aprés le login dans la section Authorize présente en haut à droite de la page)
* mobile : http://api.mobile.local:19180/swagger/index.html (veuillez intégrer token aprés le login dans la section Authorize présente en haut à droite de la page)
* player : http://api.player.local:19280/swagger/index.html


##Fonctionnalités

* Toutes les fonctionnalités obligatoires et additionnelles sont realisées côté back-end