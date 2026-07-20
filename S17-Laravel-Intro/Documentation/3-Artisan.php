<?php 
/* 

-----------------------------------------------------------------------
-----------------------------------------------------------------------
------ Chapitre 3 - Artisan command line ------------------------------
-----------------------------------------------------------------------
-----------------------------------------------------------------------

--- Qu'est-ce qu'Artisan ?
Artisan est l'interface en ligne de commande officielle de Laravel.
Il permet d'exécuter de nombreuses tâches directement depuis le terminal, sans avoir à créer ou modifier manuellement certains fichiers.

Grâce à Artisan, il est notamment possible de :
créer des contrôleurs 
créer des modèles 
créer des migrations 
lancer le serveur de développement 
vider le cache 
exécuter les migrations 
lancer les tests 
afficher des informations sur l'application.

Artisan permet donc d'automatiser une grande partie du travail du développeur.

--- Comment fonctionne Artisan ?

Toutes les commandes Artisan commencent par :
php artisan
php exécute l'interpréteur PHP.
artisan est le programme fourni par Laravel.
On ajoute ensuite une commande spécifique.

Exemple :
php artisan migrate

--- Afficher la version de Laravel
Pour connaître la version de Laravel utilisée dans le projet :
php artisan --version
Cette commande permet également de vérifier qu'Artisan fonctionne correctement.


--- La commande about
Laravel propose une commande permettant d'obtenir rapidement des informations sur le projet :
php artisan about
Cette commande affiche notamment :
la version de Laravel 
la version de PHP 
l'environnement utilisé 
les informations sur la base de données 
les systèmes de cache 
les principaux services configurés.


--- Les commandes make
Les commandes make: permettent de générer automatiquement différents fichiers.
Au lieu de créer manuellement un fichier et de respecter l'arborescence du framework, Laravel s'occupe de tout.
php artisan make:controller EmployeController 

--- Lancer le serveur de développement
Laravel intègre un serveur web destiné au développement.
Il peut être lancé grâce à la commande :
php artisan serve
Par défaut, le site est accessible à l'adresse :
http://127.0.0.1:8000


--- Pourquoi utiliser Artisan ?
Artisan présente plusieurs avantages :
il automatise la création de nombreux fichiers 
il réduit les erreurs de manipulation 
il respecte automatiquement l'architecture de Laravel 
il accélère considérablement le développement.
Il fait partie des outils essentiels du framework Laravel.

*/