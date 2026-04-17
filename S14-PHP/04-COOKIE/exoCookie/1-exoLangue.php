<?php

/*

    EXERCICE COOKIE :
            Mémorisation d'un choix de langue par l'utilisateur : 

                Etapes : 
                    - 1 Créer 4 liens HTML représentant des langues 
                    
                    - 2 Via le GET, transmettre les informations de la langue cliquée
                    - 3 En fonction de la langue cliquée, créer un cookie correspondant
                    - 4 Vérifier le fonctionnement en revenant sur la page pour voir si la langue a été mémorisée (afficher la langue sélectionnée ou une phrase dans la langue en question)
                    - 5 Bien faire en sorte que le choix de langue soit cohérent (quelle serait la priorité entre le cookie, le choix utilisateur, le choix par défaut)

*/
if (!isset($_COOKIE["langue"])) {
    setcookie("langue", "fr", time() + (365 * 24 * 60 * 60));
}

if (isset($_GET["langue"])) {
    $selectedLangue = $_GET["langue"];
    setcookie("langue", $selectedLangue, time() + (365 * 24 * 60 * 60));
    header("Location: 1-exoLangue.php");
} else if (isset($_COOKIE["langue"])) {
    $langue = $_COOKIE["langue"];
    setcookie("langue", $langue, time() + (365 * 24 * 60 * 60));
} else {
    $langue = "fr";
}
$bonjour = match ($langue) {
    'fr' => "Bonjour !",
    'en' => "Hello!",
    'es' => "¡Hola!",
    'jp' => "こんにちは！",
    default => "Langue non reconnue."
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <body>
        <div class="container mt-5">
            <h1>Choisir une langue</h1>
            <p>
                <a href="?langue=fr" class="btn btn-light <?= $langue === 'fr' ? 'disabled' : ''; ?>">Français</a>
                <a href="?langue=en" class="btn btn-dark <?= $langue === 'en' ? 'disabled' : ''; ?>">English</a>
                <a href="?langue=es" class="btn btn-primary <?= $langue === 'es' ? 'disabled' : ''; ?>">Español</a>
                <a href="?langue=jp" class="btn btn-secondary <?= $langue === 'jp' ? 'disabled' : ''; ?>">日本語</a>
            </p>
            <p>Langue actuelle : <strong><?= ucfirst($langue) ?></strong></p>
            <p><?= $bonjour ?></p>
        </div>
    </body>

</html>