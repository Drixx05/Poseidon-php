<?php 

/* 

    EXERCICE : 
        La base de la manipulation de GET 
        
            Etapes :
                - Créer 4 liens indiquant 4 pays différents 
                - Sur chaque lien, créer une valeur GET à transmettre sur la même page
                - En fonction de la valeur transmise, afficher un message (par exemple pour un choix "France", afficher "Vous êtes français")

*/


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GET exo 1</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 30px 0;
    }

    li {
        margin: 12px 0;
    }


    li a {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 18px;
    }

    li a:hover {
        background-color: #0056b3;
    }

    h2 {
        font-size: 28px;
        color: #333;
        margin-top: 40px;
    }
</style>

<body>
    <ul>
        <li><a href="?nat=français">France</a></li>
        <li><a href="?nat=espagnol">Espagne</a></li>
        <li><a href="?nat=italien">Italie</a></li>
        <li><a href="?nat=suisse">Suisse</a></li>
    </ul>

    <div>

        <?php
        if (isset($_GET["nat"])) echo "<h2> Vous êtes " . $_GET["nat"] . "</h2>";
        else echo "<h2>Choisissez un pays</h2>";
        ?>

    </div>

</body>

</html>