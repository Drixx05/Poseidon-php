<?php 
/* 

-----------------------------------------------------------------------
-----------------------------------------------------------------------
------ Chapitre 1 - Installation de Laravel ---------------------------
-----------------------------------------------------------------------
-----------------------------------------------------------------------

Pour installer Laravel nous avons besoin de plusieurs choses 

php  (déjà installé au travers de wamp)
composer (à télécharger sur le site composer)
node.js (à installer)
npm (à installer)

--- Vérification des pré-requis dans le terminal : 
    php -v   (version au moins 8.3 pour Laravel 13)
    composer -v 
    node -v 
    npm -v 

--- Le Laravel Installer 
Laravel fournit un petit programme appelé Laravel Installer.
Une fois installé, il nous ajoute une nouvelle commande dispo dans le terminal : 
laravel 

Cette commande nous permet de créer des projets laravel 
Installation : 
composer global require laravel/installer  

Vérification : 
    laravel --version 

-- Création d'un projet 
Pour créer un projet Laravel : 
laravel new entreprise-poseidon

Pour nous, on installe Laravel sans starter kit 
Réponse dans le terminal : 
Starter kit ? None 
(which stack you want to build on ?  Blade)
Which testing framework ? PHPUnit
Install Laravel Boost for AI ? no 
Which database ? mysql 
Run default migrations? yes
database does not exit, would you like to create it ? yes
Would you like to run npm install and npm run build ? yes

--- Le rôle de Node.js
Laravel ne repose pas uniquement sur PHP.
Les ressources Front-End (CSS et JavaScript) sont gérées par Node.js.
Les dépendances JavaScript sont définies dans le fichier :
package.json

Elles sont installées grâce à la commande :
npm install

--- Vite
Laravel utilise Vite pour compiler automatiquement les ressources Front-End.

Le serveur Vite est lancé avec :
npm run dev

Pendant le développement, cette commande reste généralement ouverte dans un second terminal.
À chaque modification des fichiers CSS ou JavaScript, les ressources sont automatiquement recompilées.

--- Le serveur de développement
Pendant le développement, Laravel embarque un petit serveur web.

Celui-ci est lancé grâce à Artisan :
php artisan serve

Par défaut, l'application est accessible à l'adresse :
http://127.0.0.1:8000

Ce serveur est uniquement destiné au développement.
En production, Laravel sera exécuté par un véritable serveur web (Apache ou Nginx).


Les principales commandes utilisées : 

composer global require laravel/installer	    Installe le Laravel Installer
laravel --version	                            Affiche la version du Laravel Installer
laravel new entreprise	                        Crée un nouveau projet Laravel
cd entreprise	                                Se déplacer dans le dossier du projet
npm install	                                    Installer les dépendances Front-End
php artisan serve	                            Lancer le serveur de développement
composer run dev	                            Lancer le serveur Vite

Une fois php artisan serve et composer run dev lancés depuis le dossier d'installation c'est bon ! 


A partir de là le projet est créé et ready to go !
*/