<?php

/*

    EXERCICE POST :
            Formulaire inscription utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une inscription utilisateur (pseudo, email, password, confirm password)
                    - 3 Controler ces informations reçues dans POST (taille pseudo, format email, longueur password et correspondance avec le confirm, vérifier si le pseudo n'est pas déjà pris)
                    - 4 Si tout est ok, crypter/hasher le mot de passe avec password_hash et l'insérer dans  $_SESSION['users'] puis afficher un message de confirmation d'inscription
                    - 5 Si pas ok, afficher des messages d'erreur en rapport avec les problèmes de saisies (et on conserve les saisies utilisateurs pour lui éviter de tout resaisir)

*/

session_start();

// var_dump($_POST);

if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = [];
}

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST["password_confirm"])) {

    $pseudo = trim($_POST["pseudo"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $passwordConfirm = trim($_POST["password_confirm"]);

    // Contrôle de validation 

    // Tous les champs sont obligatoires
    if (empty($pseudo) || empty($email) || empty($password) || empty($passwordConfirm)) {
        $errors[] = "Tous les champs sont obligatoires !";
    }

    // Format d'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Le format d'email n'est pas valide";
    }

    // Taille du pseudo
    if (iconv_strlen($pseudo) < 3) {
        echo "<h1>COUCOU dans le if strlen pseudo</h1>";
        $errors[] = "Le pseudo est trop court, minimum 3 caractères";
    }

    // Taille du password
    if (iconv_strlen($password) < 6) {
        $errors[] = "Le password est trop court 6 caractères mini !";
    }

    // Correspondance des deux passwords
    if ($password != $passwordConfirm) {
        $errors[] = "Les mots de passe ne se correspondent pas";
    }

    // Doublon de pseudo
    foreach ($_SESSION["users"] as $user) {
        if ($user["pseudo"] == $pseudo) {
            $errors[] = "Le pseudo est déjà pris.";
            break;
        }
    }

    // Si pas d'erreurs, ma variable $errors est vide, c'est ce qui va me servir de controle pour lancer l'insertion
    if (empty($errors)) {
        $passwordHashed = password_hash($password, PASSWORD_ARGON2ID);
        $_SESSION["users"][] = ["pseudo" => $pseudo, "email" => $email, "password" => $passwordHashed];
        $success = "Inscription réussie ! Rendez vous à la page de connexion";
    }
}

// var_dump($errors);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Inscription</h1>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                    </div>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
        <?php
        echo "<pre>";
        print_r($_SESSION["users"]);
        echo "</pre>";
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>