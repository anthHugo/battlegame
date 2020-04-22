# BattleGame
Il s'agit de coder en PHP objet une simulation de jeu de bataille (le jeu de carte) en version simplifiée :

* 52 cartes, on simplifie en utilisant simplement des valeurs de 1 à 52
* les cartes sont mélangées et distribuées à 2 joueurs
* chaque joueur retourne la première carte de son paquet, le joueur disposant de la plus forte carte marque un point
* on continue jusqu'à ce qu'il n'y ait plus de carte à jouer
* on affiche le nom du vainqueur

## Comment démarrer

Pour démarrer cloner le dépôt et exécuter la stack Docker  :

```bash
git clone git@github.com:anthHugo/battlegame.git
cd battlegame/
composer install
```

Se rendre sur http://localhost:8443 pour accèder à l'api

Pour lancer une partie, lancer la commande :

```bash
php bin/battlegame
```

## Tests

Pour lancer les tests PHPUnit, exécuter:

```bash
php vendor/bin/phpunit
```