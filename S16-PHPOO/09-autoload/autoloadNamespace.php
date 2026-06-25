<?php 

// Amélioration de notre autoload pour qu'il soit capable de gérer les namespaces liés avec des sous dossiers 

// Comme on l'a vu dans le chapitre des namespaces, les projets modernes utilisent des namespaces pour une organisation des classes dans les sous dossier
// On fera en sorte de respecter la norme PSR-4 pour aller piocher nos classes dans les dossiers correspondant 

function inclusionAuto(string $class)
{ // Ici on attend un param $class qui va être le nom de la classe nommée et dont on doit inclure le fichier sur cette page 

    // En fonction des serveurs et systèmes d'arborescence, les anti slash des namespace peuvent créer des problèmes sur les chemins d'accès aux fichiers
    // On hésite pas à les remplacer par des slash classiques 
    $class = str_replace('\\', '/', $class);   

    // On va modéliser le chemin d'accès jusqu'au fichier à inclure 
    $file = __DIR__ . "/src/" . $class . ".php";

    var_dump($file); // On vérifie notre concaténation

    if (file_exists($file)) { // Si on trouve bien un fichier à ce chemin là on rentre dans le if 
        require_once $file; // Et on require le fichier trouvé 
    }
}


// spl_autoload_register c'est une fonction qui se déclenche dès qu'elle voit une instanciation 
// Elle comprend ici qu'elle doit lancer une fonction qui s'appelle inclusionAuto()
// Elle enverra automatiquement un param étant le nom de la classe (comprennant le namespace s'il y en a un!)
spl_autoload_register("inclusionAuto");