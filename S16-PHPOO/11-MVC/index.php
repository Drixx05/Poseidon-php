<?php

use ProjetMVC\Controller\UserController;

// Ici index.php c'est le point d'entrée de mon architecture
// L'utilisateur ne bouge pas de page en page, mais c'est le contenu des pages qui vient à lui sur index.php 

require "vendor/autoload.php";

// Pour mettre en place un routage vers différent controller, on le ferait via un param GET 
$controllers = ["user", "product"];

// On ferait la verif via un param get, qui instancierai le bon controller 
// En ayant uniformisé tous nos controllers, l'unique fait que le controller soit différent, change la totalité du contenu de nos pages, on est completement sous d'autres contexte, par exemple les affichages des produits etc 
if (isset($_GET["ctrl"]) && in_array($_GET["ctrl"], $controllers)){
    if ($_GET["ctrl"] == "product") {
        // $controller = new ProductController;
    } elseif ($_GET["ctrl"] == "user") {
        $controller = new UserController;
    }
} else {
    // On instancie le controller c'est lui qui va comprendre les flux de navigation/requete user 
$controller = new UserController;
}



// Le lancement de cette méthode permet au controller de comprendre les scénarios d'arrivée sur notre app 
$controller->handleRequest();