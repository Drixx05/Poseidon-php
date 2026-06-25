<?php

/* 

    - Autoload : Concept de base 

    En PHP l'autoload nous sert à charger les fichiers contenant nos classes automatiquement

    Sans autoload on devrait require nous même tous nos fichiers 
*/

// require "classes/Utilisateur.php";
// require "classes/UtilisateurController.php";
// require "classes/FormValidator.php";
// require "classes/SessionManager.php";
// require "classes/Config.php";

/* 

Le but de l'autoload est donc d'insérer dans le fichier en cours UNIQUEMENT les classes dont on a besoin. 
Comment ça marche ? Dès lors que l'autoload vers la mention d'une classe, soit par un new, soit par un appel static par exemple, il sera capable d'avant l'instruction en question, d'insérer le fichier contenant cet élément nommé 

Par exemple : 
$article = new Article;
L'autoload va comprendre qu'il doit require("Article.php");


*/

// Création d'un autoload simple à la main : 

function inclusionAuto(string $class)
{ // Ici on attend un param $class qui va être le nom de la classe nommée et dont on doit inclure le fichier sur cette page 

    // On va modéliser le chemin d'accès jusqu'au fichier à inclure 
    $file = __DIR__ . "/Classes/" . $class . ".php";

    var_dump($file); // On vérifie notre concaténation

    if (file_exists($file)) { // Si on trouve bien un fichier à ce chemin là on rentre dans le if 
        require_once $file; // Et on require le fichier trouvé 
    }
}


// spl_autoload_register c'est une fonction qui se déclenche dès qu'elle voit une instanciation 
// Elle comprend ici qu'elle doit lancer une fonction qui s'appelle inclusionAuto()
// Elle enverra automatiquement un param étant le nom de la classe (comprennant le namespace s'il y en a un!)
spl_autoload_register("inclusionAuto");



// $article = new Article; // Si j'instancie ici Article, le système comprends qu'il doit aller le chercher dans le dossiers Classes de notre projet 