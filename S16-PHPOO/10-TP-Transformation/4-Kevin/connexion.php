<?php

require_once __DIR__ . "/vendor/autoload.php";

use ProjetKevin\SessionManager;
use ProjetKevin\Utilisateur;

SessionManager::start();

$loginError = "";
$loginSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"], $_POST["password"])) {
    $pseudo = trim($_POST["pseudo"]);
    $password = trim($_POST["password"]);

    $user = Utilisateur::findByPseudo($pseudo);

    if ($user && password_verify($password, $user->getPassword())) {
        SessionManager::set("logged_in", $user->getPseudo());
        $loginSuccess = "Connexion réussie. Bienvenue, " . htmlspecialchars($user->getPseudo()) . " !";
    } else {
        $loginError = "Pseudo ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - POO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">TP POO</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="inscription.php">Inscription</a>
                <a class="nav-link active" href="connexion.php">Connexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Connexion</h1>

                <?php if ($loginError): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
                <?php endif; ?>

                <?php if ($loginSuccess): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($loginSuccess) ?></div>
                <?php endif; ?>

                <?php if (SessionManager::has("logged_in")): ?>
                    <div class="alert alert-info">
                        Vous êtes connecté en tant que : <strong><?= htmlspecialchars(SessionManager::get("logged_in")) ?></strong>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>