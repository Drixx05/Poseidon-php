<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 4 — Les Routes 
----------------------------------------------------------------------------

--- Pourquoi les routes existent-elles ?
En PHP natif, chaque page du site correspond généralement à un fichier.
Par exemple :
index.php
contact.php
services.php
login.php

Lorsqu'un utilisateur saisit une URL dans son navigateur, il demande directement un fichier au serveur.

Laravel fonctionne différemment.
Toutes les requêtes arrivent d'abord dans un unique fichier situé dans le dossier public/ :
public/index.php

Ce fichier constitue le point d'entrée de l'application.
Laravel analyse ensuite l'URL demandée afin de déterminer quel code doit être exécuté.
Cette étape est réalisée par le système de routing.
Une route est donc une règle qui associe une URL à une action.

--- Où sont définies les routes ?
Toutes les routes destinées au site web sont définies dans le fichier :
routes/web.php
Exemple fourni par Laravel :
Route::get('/', function () {
    return view('welcome');
});

Cette route signifie :
lorsqu'un utilisateur demande l'URL /, (notre index de base de notre projet)
Laravel exécute la fonction associée,
puis retourne la vue welcome.  (qui est un fichier welcome.blade.php dans le dossier resources)

--- Les méthodes HTTP
Une route répond toujours à une méthode HTTP.
Les deux méthodes les plus courantes sont :

Méthode	Utilisation
GET	    Afficher une ressource ou une page
POST	Envoyer des données au serveur
(A voir plus tard semaine 2, PUT, PATCH, DELETE)

--- Les routes GET
La méthode Route::get() permet de répondre à une requête HTTP de type GET.

Syntaxe :
Route::get('/url', function () {
    // Code exécuté
});

// On peut retourner du texte ou du html mais on préfèrera retourner une vue 

--- Retourner une vue
Pour afficher une véritable page HTML, on utilise le helper view().
Exemple :
Route::get('/bonjour', function () {
    return view('bonjour');
});

Laravel recherchera automatiquement le fichier :
resources/views/bonjour.blade.php 
On sépare la logique PHP de l'affichage HTML 

--- Passer des données à une vue
Une vue n'est pas limitée à du HTML statique.
Il est possible de lui transmettre des données.
Route::get('/bonjour/{prenom}', function($prenom) {
    return "Bonjour $prenom";
});

// ON aura donc accès à un $prenom sur la vue 

--- Les routes POST
Une route POST est utilisée lorsqu'un utilisateur envoie des données via un form method POST
ATTENTION deux routes peuvent avoir la meme URL mais une méthode différente ! Attention à bien dissocier les deux 

--- Les routes nommées
Une route peut recevoir un nom.

Exemple :
Route::get('/employes', function () {
    // ...
})->name('employes');
Le nom de la route est totalement indépendant de son URL.
Il permet de référencer une route plus facilement dans le reste de l'application.
Egalement, si l'URL venait à changer, on aurait aucune problématique de lien cassé car on se referera toujours au nom de la route 

--- Ce qu'il faut retenir : 
Les routes constituent le point d'entrée de toute application Laravel.


*/