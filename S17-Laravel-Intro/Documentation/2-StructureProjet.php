<?php 
/* 

-----------------------------------------------------------------------
-----------------------------------------------------------------------
------ Chapitre 2 - Structure Projet ----------------------------------
-----------------------------------------------------------------------
-----------------------------------------------------------------------

--- Structure générale d'un projet Laravel
Lorsqu'un projet Laravel est créé, de nombreux dossiers et fichiers sont générés automatiquement.
Cette structure peut sembler impressionnante au premier abord, mais chaque dossier possède une responsabilité bien précise.
Au quotidien, un développeur Laravel ne travaille généralement que dans quelques dossiers, les autres étant principalement utilisés par le framework lui-même.

--- Le dossier app/
Le dossier app/ est le cœur de notre application.
C'est ici que se trouve tout le code métier que nous allons écrire.
On y retrouve notamment :
les contrôleurs
les modèles
les middlewares
les commandes Artisan personnalisées
les éventuels services ou classes métiers

(c'est le dossier qu'on utilisera le plus !)

--- Le dossier bootstrap/
Le dossie bootstrap/ sert au démarrage de Laravel.
Il contient les fichiers nécessaires à l'initialisation du framework.
On y trouve notamment :
le fichier de démarrage de Laravel ;
un dossier cache/ utilisé pour accélérer certaines opérations.

--- Le dossier config/
Le dossier config/ contient tous les fichiers de configuration de Laravel.
Chaque fichier correspond à une partie précise du framework.
Par exemple :
config/
app.php
database.php
mail.php
cache.php
session.php
Ces fichiers permettent de configurer le comportement de Laravel.
Une grande partie de ces paramètres utilise les variables définies dans le fichier .env.

--- Le dossier database/
Le dossier database/ regroupe tout ce qui concerne la base de données.
On y retrouve principalement :
les migrations
les seeders
les factories
Exemple :
database/
factories/
migrations/
seeders/
Les migrations permettent de créer la structure des tables.
Les seeders servent à insérer des données.
Les factories génèrent automatiquement de grandes quantités de données de test.

--- Le dossier public/
Le dossier public/ est le point d'entrée de l'application.
C'est le seul dossier accessible directement depuis le navigateur.
Il contient notamment :
le fichier index.php
les images publiques
les fichiers CSS et JavaScript compilés.
Toutes les requêtes HTTP passent d'abord par ce dossier avant d'être transmises à Laravel.

--- Le dossier resources/
Le dossier resources/ contient les ressources utilisées par l'application.
On y retrouve principalement :
les vues Blade
les fichiers CSS
les fichiers JavaScript
Exemple :
resources/
views/
css/
js/
Le dossier views/ sera très utilisé durant la formation en plus de notre app
C'est ici que seront créées toutes les pages HTML de notre application.

--- Le dossier routes/
Le dossier routes/ contient toutes les routes de l'application.
Laravel sépare les routes selon leur utilisation.
Les principaux fichiers sont :
web.php
console.php
Le fichier web.php contient les routes destinées au site web.

--- Le dossier storage/
Le dossier storage/ est utilisé par Laravel pour stocker différents fichiers générés automatiquement.
On y trouve notamment :
les fichiers de cache ;
les journaux d'erreurs (logs) ;
les fichiers temporaires ;
les fichiers uploadés selon la configuration choisie.
Ce dossier est principalement géré par Laravel.

--- Le dossier vendor/
Le dossier vendor/ contient toutes les bibliothèques installées avec Composer.
Laravel lui-même se trouve en grande partie dans ce dossier.
Chaque dépendance installée via Composer est automatiquement copiée dans vendor/.
Ce dossier peut contenir plusieurs milliers de fichiers.
Il ne doit jamais être modifié manuellement.

--- Le fichier .env
Le fichier .env contient les variables d'environnement de l'application.
Il permet notamment de définir :
le nom de l'application
le mode de fonctionnement (développement ou production)
les informations de connexion à la base de données
les paramètres des services externes.
Exemple :
APP_NAME=Entreprise
APP_ENV=local
APP_DEBUG=true
DB_CONNECTION=mysql
DB_DATABASE=entreprise
Grâce à ce système, il est possible de modifier la configuration d'un projet sans toucher au code source.


*/