<?php 

/*

Exercice 1 : Contrôle d'accès à une page admin avec exit / die

Objectif : Simuler un contrôle d’accès à une page d’administration en utilisant exit() ou die() pour stopper l’exécution du script si l’utilisateur n’a pas les droits nécessaires.

Énoncé :

    Créez un fichier gestion.php.
    Simulez un utilisateur connecté avec dans la session, un indice user auquel sont stockés des informations, notamment le rôle (valeurs possibles : 'admin', 'user').
    Si l'utilisateur n'a pas le rôle d'admin, utilisez die() ou exit() pour afficher un message d'erreur et interrompre l'exécution de la page. Sinon, affiche le contenu de la page d'administration.

*/


$user1 = new stdClass();
$user1->role = "admin";
$user1->nom = "Alice";

$user2 = new stdClass();
$user2->role = "user";
$user2->nom = "Nicole";

function verifUser($user) {

    if(!isset($user)) {
        throw new Exception("L'utilisateur n'existe pas !");
    }

    if($user->role != "admin") {
        exit("Erreur : Impossible d'accéder à la page");
    }
    
}

// verifUser($user2); // (le code s'arrête)

verifUser($user1);

echo "<h1>PAGE D'ADMINISTRATION</h1>";
echo "Bonjour " . $user1->nom . ", bienvenue sur la page d'administrateur.";


?>