<?php

/*

    EXERCICE POST :
            Choix plat au restaurant : 

                Etapes : 
                    - 1 Créer un form en POST avec simplement un champ select (liste deroulante) avec plusieurs choix de plat possible puis un bouton de validation
                    - 2 Traiter la réponse en exploitant POST puis en affichant un message indiquant le choix de l'utilisateur

*/

var_dump($_POST);

$message = "";
$plats = ["Pizza", "Burger", "Sushi", "Salade"]; // Ici je défini un array qui contient tout les plats "autorisés"


// On fait toujours notre double verif avant toute chose, la verif du Request Method et la verif du isset de tous les champs attendus
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["plat"])) {

    $plat = trim($_POST['plat']);

    if (in_array($plat, $plats)) { // in_array me permet de confirmer si le plat reçu du POST fait bien parti des plats autorisés
        $message = "<div class='alert alert-success mt-3'>Vous avez choisi <strong>$plat</strong> comme votre plat préféré !</div>";
    } else {
        $message = "<div class='alert alert-warning mt-3'>Plat inconnu !</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de Plat Préféré</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Choisissez votre plat préféré</h1>

                <!-- On oublie pas le method post  -->
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="plat" class="form-label">Sélectionnez un plat :</label>
                        <!-- Dans un champ select, on met le name dans la balise select  -->
                        <select class="form-select" id="plat" name="plat" required>
                            <!-- Pour les balises options c'est la valeur du value qui sera transmise au php -->
                            <!-- Si le value n'est pas renseigné alors c'est le nom de l'option qui sera transmise -->
                            <option value="Pizza">Pizza</option>
                            <option value="Burger">Burger</option>
                            <option value="Sushi">Sushi</option>
                            <option value="Salade">Salade</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>

                <!-- Affichage du message si un choix a été fait -->
                <?= $message ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>