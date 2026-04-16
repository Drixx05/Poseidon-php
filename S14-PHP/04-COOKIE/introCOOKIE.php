<?php

/*

Les cookies sont des petits fichiers de données que les serveurs stockent sur le navigateur de l'utilisateur !  
Ils permettent aux applications web de conserver des informations d'une connexion à l'autre d'un même utilisateur.
Par exemple, les préférences d'un utilisateur, les informations de session, même après la fermeture du navigateur ou la deconnexion de l'utilisateur 

En PHP les cookies sont gérés via la superglobale $_COOKIE : encore une fois c'est un ARRAY 

    Stockage d'informations à long terme :  Contrairement à $_SESSION qui stocke des données côté serveir et expire lorsqu'un utilisateur ferme le navigateur (généralement), un cookie peut persister plus longtemps (souvent 1an de validité !)
    Personnalisation : Ils peuvent être utilisés pour enregistrer des préférences, la langue, le thème, la dernière catégorie visitée pour améliorer l'expérience utilisateur lors des prochaines visites 
    Suivi utilisateur : Ils permettent de suivre les utilisateurs d'une page à l'autre voire d'un site à l'autre 

// Manipulation de cookies en PHP 

    // 1 - Création d'un cookie 

    Pour créer un cookie on utilise la fonction setcookie() (à envoyer avant initialisation de la page donc avant le DOCTYPE etc) 

    // setcookie(name, value, expire, path, domaine, secure, httponly);

    name : Nom du cookie (obligatoire)
    value : Valeur du cookie (obligatoire)
    expire : Timestamp de la date d'expiration. Par défaut un cookie expire à la fermeture de la session
    path : Chemin sur le serveur où le cookie sera accessible. Par défaut, il est accessible sur l'entièreté du site 
    domain : Domaine pour lequel le cookie est valable 
    secure : Si défini à true, le ocokie sera envoyé uniquement via HTTPS 
    httponly : Si défini à true, le cookie ne sera pas accessible via JS 

    // setcookie("username", "Pierra", time() + 3600);
    Ici un cookie username avec la valeur Pierra qui périme dans 1h ! 

    // 2 - Lecture d'un cookie

    Pour aller vérifier le contenu des cookies, c'est au travers de la superglobale !  
    if (isset($_COOKIE["username"])) {
    echo "Bonjour : " . $_COOKIE["username"] }

    // 3 - Suppression d'un cookie 
    Pour supprimer un cookie il faut simmplement le refresh en lui donnant une date passée 

*/


// Si l'utilisateur choisit un thème en cliquant sur le bouton, je vais le traiter avec le GET et lui créer un cookie

if (!isset($_COOKIE["theme"])) {
    setcookie("theme", "clair", time() + (365 * 24 * 60 * 60));
}

if (isset($_GET["theme"])) {
    $selectedTheme = $_GET["theme"];
    setcookie("theme", $selectedTheme, time() + (365 * 24 * 60 * 60));
    header("Location: introCOOKIE.php");
} else if (isset($_COOKIE["theme"])) {
    $theme = $_COOKIE["theme"];
    setcookie("theme", $theme, time() + (365 * 24 * 60 * 60));
} else {
    $theme = "clair";
}



var_dump($_COOKIE);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de gestion de thème avec cookie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: <?= $theme === 'sombre' ? '#333' : '#fff'; ?>; color: <?= $theme === 'sombre' ? '#fff' : '#000'; ?>;">
    <div class="container mt-5">
        <h1>Choisir un thème</h1>
        <p>
            <a href="?theme=clair" class="btn btn-light <?= $theme === 'clair' ? 'disabled' : ''; ?>">Thème Clair</a>
            <a href="?theme=sombre" class="btn btn-dark <?= $theme === 'sombre' ? 'disabled' : ''; ?>">Thème Sombre</a>
        </p>
        <p>Thème actuel : <strong><?= ucfirst($theme) ?></strong></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>