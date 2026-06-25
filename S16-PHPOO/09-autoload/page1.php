<?php 

// Ici au lieu de faire mes requires de toutes mes classes, je lance simplement l'autoload 

require("autoload.php");

// Avec l'instanciation ci dessous, l'autoload comprend qu'il doit s'activer et va inclure automatiquement le fichier Article.php contenu dans le dossiers Classes 
$article = new Article;
$user = new UserA;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>