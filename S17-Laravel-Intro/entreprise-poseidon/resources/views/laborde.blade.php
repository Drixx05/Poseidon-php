<?php 

// Ici je récupère bien la variable employe transmise au travers de la route 
var_dump($employe);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Ici j'utilise blade pour afficher le nom de l'employe -->
{{-- Pas mal ! Ah ? Ici ce commentaire ne s'affiche pas dans le code source ! C'est comme un comm php ! --}}
    <h1> {{$employe["nom"]}} </h1>
    <a href="{{route('employes')}}">Liste des employes</a>
</body>
</html>