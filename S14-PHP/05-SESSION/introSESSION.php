<?php 

/* 

    Le système de sessoin en PHP est un mécanisme qui nous permet de maintenir des informations entre le serveur et le client tout au long de sa navigation peu importe s'il change de pas ou pas.

    En PHP, encore une fois, une superglobale associée au process des sessions c'est : $_SESSION encore une fois c'est un array par defaut vide 

    ATTENTION c'est la seule globale qui n'existe pas par défaut, elle est toujours conditionnée par l'exécution de l'instruction session_start();

    A quoi ça sert ? C'est finalement un array vide et disponible pour tout ce que l'on souhaite 

    Souvent utilisée dans : 

    Stocker des informations utilisateurs sur plusieurs pages (des données de connexion ou le contenu d'un panier d'achat)
    Gérer des états utilisateurs (connecté, pas connecté, admin, user) 
    Protéger certaines informations plutôt que de les exposer dans des cookies 
    Message flash : on a souvent besoin d'afficher des messages à l'utilisateur mais on va parfois transiter par des pages intermediaires, pour éviter de perdre les informations transmises par le GET, on peut ainsi les stocker dans la session pour être sur de les conserver jusqu'à ce qu'un affichage soit possible 

    Fonctionnement des sessions : 

    Demarrage d'une session : Une session commence quand on appelle session_start(). Ca génère un identifiant unique de session côté serveur et place cet identifiant dans un cookie sur le navigateur de l'utilsiateur 

    Stockage de données dans $_SESSION : Les données stockées dans $_SESION agissent comme un array associatif. On peut y ajouter modifier supprimer des infos 

    Persistance entre pages : Tant que la session est active (jusqu'à ce qu'elle soit détruite), ces informations seront accessibles sur toutes les pages 

*/

// Les principales fonctions de gestion de session

// session_start() : démarre une nouvelle session ou reprends une session existante. Elle doit être appelé au tout début de toutes nos pages.
session_start();

var_dump($_SESSION);

// $_SESSION : Cette superglobale est un array associatif qui stocke les informations de session
$_SESSION["username"] = "Pierra";
echo $_SESSION["username"];
unset($_SESSION["username"]);

// session_destroy() : Détruit toutes les données de la session sur le serveur. 
session_destroy();

// session_unset() : SUpprime tout le contenu de la session sans la détruire
session_unset();

// session_regenerate_id() : Change l'ID de session pour renforcer la sécurité, on envoie cette instruction de temps en temps en fonction des opérations sur le site, par exemple une connexion, une commande, une modification d'informations perso pour éviter les attaques de fixation de session 
session_regenerate_id(true);

// Etendre la durée de vie de la session pour maintenir une conexion, se fait généralement dans les reglages du PHP ini 
ini_set("session.cookie_lifetime", 30*24*60*60); // Augmente la durée du vie du cookie session
ini_set("session.gc_maxlifetime", 30*24*60*60); // Augmente la durée du vie du fichier de session serveur

// ATTENTION la plupart des opérations de session ne fonctionne pas une fois la page initialisée (après le DOCTYPE)

// PHP possède un système de "nettoyage automatique" des fichiers de session sur le serveur par le procédé du GC "Garbage Collection"
// En gros à chaque opération de session, il y a une petite probabilité que l'opération de nettoyage se lance et supprimer les fichiers de sessions expirés du serveur 


// Par exemple manipulation de la session après une identification réussie 


// Traitement du form...
// Vérification pseudo...
// Vérification password...
// IDENTIFICATION OK !
// On remplit la session ! 

$_SESSION["connected_user"]["pseudo"] = "Pierra";
$_SESSION["connected_user"]["email"] = "Pierra@gmail.com";
$_SESSION["connected_user"]["role"] = "admin";
$_SESSION["logged_in"] = true;

// Les informations ci dessus seront accessible tout au long de la navigation peu importe que l'on change de page ou pas, TANT QUE on lance convenablement bien sur chacune de nos pages l'instruction session_start()











?>

