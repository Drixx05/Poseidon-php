<?php

/* 

Le protocole POST est l'un des deux principaux protocoles utilisés pour envoyer des données d'un navigateur web vers un serveur. (l'autre étant GET)
Contrairement à GET qui envoie les données dans l'URL (visible), POST les envoie dans le corps de la requête HTTP  ce qui permet de transmettre des informations plus volumineuses, plus sensibles et de manière plus sécurisée 

en PHP on utilise le protocole POST pour les envoie de formulaire !  

Bien que les formulaires puissent aussi être envoyer en GET, on les enverra TOUJOURS en POST 

En PHP on manipule les données envoyée par POST au travers de la superglobale associée à savoir $_POST, tout comme les autres superglobales, $_POST existe toujours et est un array !

Contextes d'utilisation de POST : 
    - Formulaire d'inscription / Connexion 

    - Enregistrement en BDD (toute action modifiant l'état d'une bdd)

    - Téléchargement de fichiers au travers de la globale $_FILES (rattachée à POST)

Pour s'assurer d'être en method POST on fera toujours la vérification de la globale serveur à sa clé REQUEST_METHOD en plus de la vérification isset 

*/

var_dump($_POST); // Grace au var_dump je me rends compte déjà si mon formulaire html est bien conçu 
// On remarque que je récupère les champs uniquement si l'attribut name est bien renseigné

// var_dump($_SERVER);

$content = "";
$nom = "";
$email = "";
$message = "";

if (isset($_POST["nom"], $_POST["email"], $_POST["message"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    $content = "
        <div class='card'>
            <div class='card-header'>
                 <h5>Informations reçues par le formulaire : </h5>
            </div>
            <div class='card-body'>
                <p class='card-text'>Nom : $nom</p>
                <p class='card-text'>Email : $email</p>
                <p class='card-text'>Message : $message</p>
            </div>
</div>
    ";
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire avec POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Contactez-nous</h1>
                <!-- ne pas oublier le method="post" -->
                <form action="" method="post" class="mb-4">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <!-- Dans chaque input/textarea/select et autres, ne pas oublier l'attribut name -->
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $nom ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

                <!-- Affichage du message du form -->
                 <?= $content ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>