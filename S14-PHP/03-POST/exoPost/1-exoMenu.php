<?php

/*

    EXERCICE POST :
            Choix plat au restaurant : 

                Etapes : 
                    - 1 Créer un form en POST avec simplement un champ select (liste deroulante) avec plusieurs choix de plat possible puis un bouton de validation
                    - 2 Traiter la réponse en exploitant POST puis en affichant un message indiquant le choix de l'utilisateur

*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['plat']) && !empty($_POST['plat'])) {
        $choix = $_POST['plat'];
        $plat = "Vous avez choisi : " . htmlspecialchars($choix);
    } elseif (isset($_POST['plat']) && empty($_POST['plat'])) {
        $plat = "Veuillez sélectionner un plat.";
    }
}

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
            <?php if (isset($plat)): ?>
                <p><?= $plat ?></p>
            <?php endif; ?>
        </form>
    </div>

</body>

</html>