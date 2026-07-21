<?php 

/* 

--- TP Jour 1 Entreprise - Route / Controllers / View - Ajout Module Services ---
Entreprise

Objectif
Mettre en pratique :
Artisan
Routes
Contrôleurs
Vues
Passage de données
Paramètres
Routes nommées

--- 1 - Créer un contrôleur
Créer un contrôleur nommé : ServiceController
Toutes les pages concernant les services devront être regroupées dans ce contrôleur.

--- 2 - Créer les vues
Créer les vues suivantes dans un dossier resources/views/services/
services/index.blade.php
services/show.blade.php

--- 3 - Définir les routes
Créer les routes suivantes.
/services       name de route : index
/services/{id}    name de route : show 

--- 4 - Créer les méthodes
Dans ServiceController, créer les méthodes :
index()
show($id)
Respecter exactement ces noms.

--- 5 - Créer les données
Dans la méthode index()/ou dans le ServiceController dans une prop, créer un tableau contenant plusieurs services.
$services = [
    [
        "id" => 1,
        "nom" => "Direction",
        "responsable" => "Jean-Pierre Laborde",
        "telephone" => "01 40 12 34 56"
    ],
    [
        "id" => 2,
        "nom" => "Comptabilité",
        "responsable" => "Claire Durand",
        "telephone" => "01 40 12 34 57"
    ],
    [
        "id" => 3,
        "nom" => "Informatique",
        "responsable" => "Thomas Chevel",
        "telephone" => "01 40 12 34 58"
    ],
    [
        "id" => 4,
        "nom" => "Assistance",
        "responsable" => "Stephanie Lafaille",
        "telephone" => "01 40 12 34 59"
    ]
];

--- 6 - Afficher la liste
Transmettre le tableau à la vue.
La page devra afficher tous les services.
Le format est libre.

--- 7 - La fiche d'un service
Créer la route :
/services/{id}
La méthode show($id) devra récupérer le paramètre.
Dans un premier temps, il est suffisant d'afficher :
Vous consultez le service n°3.
Bonus : Afficher les détails du service sélectionné 

--- 8 - Navigation
Depuis la liste des services, chaque service devra posséder un lien vers sa fiche.
Les liens devront utiliser :
route(...)   {{route()}}

--- 9 - Ajouter un menu
Créer un menu de navigation permettant d'accéder à :
Accueil
Employés
Services
Contact
Toutes les URL devront utiliser des routes nommées.
*/