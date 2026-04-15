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
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exo GET</title>
</head>
<body>
    <h1>Choisissez votre pays</h1>
    <ul>
        <li><a href="?pays=france">France</a></li>
        <li><a href="?pays=espagne">Espagne</a></li>
        <li><a href="?pays=italie">Italie</a></li>
        <li><a href="?pays=allemagne">Allemagne</a></li>
    </ul>

    <?php 
        if (isset($_GET["pays"])) {
            if ($_GET["pays"] == "france") {
                echo "Vous êtes français";
            } elseif ($_GET["pays"] == "espagne") {
                echo "Vous êtes espagnol";
            } elseif ($_GET["pays"] == "italie") {
                echo "Vous êtes italien";
            } elseif ($_GET["pays"] == "allemagne") {
                echo "Vous êtes allemand";
            }
        }
    ?>
</body>
</html>