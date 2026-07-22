<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 11 - Configuration BDD MySQL
----------------------------------------------------------------------------

--- Pourquoi configurer une base de données ?
Une application web doit conserver des informations de manière permanente.
Contrairement aux tableaux PHP qui disparaissent dès que le script se termine, une base de données permet de stocker durablement les informations.
Laravel peut fonctionner avec plusieurs moteurs de base de données :
MySQL  ---- c'est celui ci qu'on utilisera 
MariaDB
PostgreSQL
SQLite
SQL Server

--- Le fichier .env
Laravel sépare le code de la configuration.
Toutes les informations propres à notre environnement sont stockées dans le fichier .env.

Par exemple :
les identifiants de connexion à la base de données ;
les clés de chiffrement ;
les paramètres d'envoi des e-mails ;
le mode de l'application (développement ou production).
Le fichier .env n'est généralement jamais partagé publiquement.

--- Les variables de connexion
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=entreprise
DB_USERNAME=root
DB_PASSWORD=

Chaque variable possède un rôle précis :

Variable	        Description
DB_CONNECTION	    Type de base de données (le sgbd utilisé)
DB_HOST	            Adresse du serveur
DB_PORT	            Port de connexion
DB_DATABASE	        Nom de la base
DB_USERNAME	        Nom d'utilisateur
DB_PASSWORD	        Mot de passe

--- Le fichier config/database.php
Laravel ne lit pas directement le fichier .env.
Les valeurs sont récupérées par les fichiers de configuration.
Dans config/database.php, on retrouve par exemple :
env('DB_HOST')
Cette instruction signifie :
« Lire la valeur DB_HOST du fichier .env. »
Ainsi, le même projet peut fonctionner sur plusieurs machines sans modifier le code.

--- Vérifier la connexion
Une fois la configuration effectuée, la commande :
php artisan migrate
permet de vérifier que Laravel parvient à communiquer avec MySQL.
En cas d'erreur, il faut vérifier :
le nom de la base ;
l'utilisateur ;
le mot de passe ;
le serveur ;
le port.

--- Les bonnes pratiques
Ne jamais modifier directement les fichiers de configuration pour y inscrire des informations personnelles.
Utiliser le fichier .env.
Ne jamais publier son fichier .env sur Internet.
Créer une base dédiée pour chaque projet.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
configurer Laravel pour utiliser MySQL ;
comprendre le rôle du fichier .env ;
comprendre le rôle de config/database.php ;
vérifier que Laravel communique correctement avec la base de données.
*/