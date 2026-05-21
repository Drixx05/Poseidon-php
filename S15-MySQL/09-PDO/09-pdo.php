<?php

echo "<h2>01 - Connexion à la BDD avec PDO</h2>";
$dsn = "mysql:host=localhost;dbname=entreprise"; // service - host - bdd 
$login = "drixx"; // le login bdd
$password = "Restui89!!!!";  // le password du login (rien sur wamp, attention sur mamp c'est "root" ou le password que vous avez défini sur vos stacks)
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On mets les Erreurs en warning pour pouvoir les afficher ! 
);

// Création de l'objet PDO : 

$pdo = new PDO($dsn, $login, $password, $options);

var_dump($pdo); // on affiche l'objet PDO pour voir si la connexion a fonctionné.