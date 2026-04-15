<?php 

/*

    EXERCICE POST :
            Choix plat au restaurant : 

                Etapes : 
                    - 1 Créer un form en POST avec simplement un champ select (liste deroulante) avec plusieurs choix de plat possible puis un bouton de validation
                    - 2 Traiter la réponse en exploitant POST puis en affichant un message indiquant le choix de l'utilisateur

*/ 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
    <h1>Choisissez votre plat</h1>
    <form action="" method="post">
        <select name="plat" id="plat">
            <option value="">--Sélectionnez un plat--</option>
            <option value="takoyaki">Takoyaki</option>
            <option value="ramen">Tonkotsu Ramen</option>
            <option value="okonomiyaki">Okonomiyaki</option>
        </select>
        <button type="submit">Validez votre choix</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['plat']) && !empty($_POST['plat'])) {
            $choix = $_POST['plat'];
            echo "<p>Vous avez choisi : $choix</p>";
        }
    ?>
    
</body>
</html>
