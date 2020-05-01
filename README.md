# BattleGame 
![CI](https://github.com/anthHugo/battlegame/workflows/CI/badge.svg)
[![codecov](https://codecov.io/gh/anthHugo/battlegame/branch/master/graph/badge.svg)](https://codecov.io/gh/anthHugo/battlegame)
[![Infection MSI](https://badge.stryker-mutator.io/github.com/anthHugo/battlegame/master)](https://infection.github.io)

Il s'agit de coder en PHP objet une simulation de jeu de bataille (le jeu de carte) en version simplifiée :

* 52 cartes, on simplifie en utilisant simplement des valeurs de 1 à 52
* les cartes sont mélangées et distribuées à 2 joueurs
* chaque joueur retourne la première carte de son paquet, le joueur disposant de la plus forte carte marque un point
* on continue jusqu'à ce qu'il n'y ait plus de carte à jouer
* on affiche le nom du vainqueur

```bash
$ php bin/battlegame

===========================
        BattleGame
===========================
---------------------------
|  Player 1  |  Player 2  |
---------------------------
|        52  |        27  |
|        30  |        33  |
|        15  |        26  |
|        25  |        43  |
|        18  |        19  |
|        29  |        28  |
|         9  |        48  |
|        36  |        47  |
|        41  |        22  |
|        16  |        10  |
|        44  |        49  |
|        12  |         4  |
|         3  |        50  |
|        11  |        40  |
|        34  |        51  |
|        14  |         1  |
|        35  |        21  |
|         7  |        39  |
|        38  |         2  |
|        37  |        17  |
|        45  |        31  |
|        23  |        20  |
|        24  |        42  |
|        46  |        13  |
|        32  |         5  |
|         8  |         6  |
---------------------------

Winner is : Player 1
```

## Comment démarrer

Pour démarrer cloner le dépôt  :

```bash
git clone git@github.com:anthHugo/battlegame.git
cd battlegame/
```

Pour lancer une partie, lancer la commande :

```bash
php bin/battlegame
```

## Tests

Pour lancer les tests PHPUnit, exécuter:

```bash
composer install
php vendor/bin/phpunit
```
