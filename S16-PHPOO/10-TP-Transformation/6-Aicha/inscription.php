<?php

require("autoload.php");

use Core\SessionManager;
use Model\Utilisateur;
use Security\FormValidator;

SessionManager::start();

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST["password_confirm"])) {

    $pseudo = trim($_POST["pseudo"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $passwordConfirm = trim($_POST["password_confirm"]);

    if (FormValidator::isEmpty($pseudo) || FormValidator::isEmpty($email) || FormValidator::isEmpty($password)) {
        $errors[] = "Tous les champs sont obligatoires !";
    }

    if (!FormValidator::isEmail($email)) {
        $errors[] = "Le format d'email n'est pas valide.";
    }

    if (FormValidator::pseudoTooShort($pseudo)) {
        $errors[] = "Le pseudo est trop court, minimum 3 caractères.";
    }
    if (FormValidator::pseudoTooLong($pseudo)) {
        $errors[] = "Le pseudo est trop long, maximum 20 caractères.";
    }

    if (FormValidator::pswdTooShort($password)) {
        $errors[] = "Le mot de passe est trop court, minimum 6 caractères.";
    }

    if (!FormValidator::pswdEqual($password, $passwordConfirm)) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($errors)) {
        $userExiste = Utilisateur::findPseudo($pseudo);
        if ($userExiste) {
            $errors[] = "Le pseudo est déjà pris.";
        }
    }
    
    if (empty($errors)) {
        $passwordHashed = password_hash($password, PASSWORD_ARGON2ID);
        
        $insertionOk = Utilisateur::inscription($pseudo, $email, $passwordHashed);

        if ($insertionOk) {
            $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        } else {
            $errors[] = "Une erreur technique est survenue lors de l'enregistrement.";
        }
    }
}

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>