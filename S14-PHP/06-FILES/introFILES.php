<?php

/*

    $_FILES est une superglobale de PHP, encore et toujours un array ! 

    Elle est utilisée pour récupérer les informations sur les pièces jointes envoyées par un formulaire HTML 

    ATTENTION, pour que le form accepte l'envoi de pièce jointe il faut lui rajouter l'attribut enctype="multipart/form-data"

    Egalement un input type="file" ne sera pas visible dans le $_POST mais uniquement dans $_FILES 

    $_FILES est un tableau array avec des clés qui représentent des informations sur le fichier envoyé (notamment le nom du fichier et le tmp_name)

*/

// On remarque qu'il n'y a rien dans POST
// var_dump($_POST);
// Pour les pièces jointes tout se trouve dans $_FILES
var_dump($_FILES);

// Extensions autorisées 
$allowedExtensions = ["jpg", "jpeg", "png", "git", "webp"];

$uploadDir = "upload/";
$uploadMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["fichier"]["tmp_name"]; // Le chemin d'accès temporaire au fichier (dans tmp)
        $fileName = basename($_FILES["fichier"]["name"]); // le nom du fichier entier
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // L'extension du fichier uniquement 

        var_dump($fileTmpPath);
        var_dump($fileName);
        var_dump($fileExtension);

        // Vérification de l'extension du fichier 
        if (in_array($fileExtension, $allowedExtensions)) {
            // Filtra du nom du fichier (on va enlever les caractères dérangeant grace à une regex)
            $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName);
            $fileName = strtolower(pathinfo($fileName, PATHINFO_FILENAME));
            var_dump($fileName);

            // Ajout d'un identifiant unique pour éviter les collisions
            $fileName = uniqid() . "_" . $fileName . "." . $fileExtension;
            var_dump($fileName);

            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $uploadMessage = "<div class='alert alert-success'>Fichier envoyé avec succès !</div>";
            } else {
                $uploadMessage = "<div class='alert alert-danger'>Erreur lors de l'envoi du fichier !</div>";
            }
        } else {
            $uploadMessage = "<div class='alert alert-danger'>Extension non autorisée ! Uniquement des images jpg jpeg png gid webp</div>";
        }
    } else {
        // Gestion des erreurs
        switch ($_FILES['fichier']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $uploadMessage = "<div class='alert alert-danger'>Le fichier dépasse la taille autorisée par le serveur.</div>";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $uploadMessage = "<div class='alert alert-danger'>Le fichier dépasse la taille autorisée par le formulaire.</div>";
                break;
            case UPLOAD_ERR_PARTIAL:
                $uploadMessage = "<div class='alert alert-danger'>Le fichier a été partiellement téléchargé.</div>";
                break;
            case UPLOAD_ERR_NO_FILE:
                $uploadMessage = "<div class='alert alert-danger'>Aucun fichier sélectionné.</div>";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $uploadMessage = "<div class='alert alert-danger'>Dossier temporaire manquant.</div>";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $uploadMessage = "<div class='alert alert-danger'>Impossible d'écrire le fichier sur le disque.</div>";
                break;
            case UPLOAD_ERR_EXTENSION:
                $uploadMessage = "<div class='alert alert-danger'>Téléchargement arrêté par une extension PHP.</div>";
                break;
            default:
                $uploadMessage = "<div class='alert alert-danger'>Erreur inconnue lors de l'envoi du fichier.</div>";
                break;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Upload de fichier</h1>

                <?= $uploadMessage ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Sélectionnez un fichier à télécharger</label>
                        <input type="file" class="form-control" id="fichier" name="fichier" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>