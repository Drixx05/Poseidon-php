<?php

error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');
ini_set('display_errors', 1);

require_once "autoload.php";

SessionManager::start();

$db = new Database();
$userRepo = new UserRepository($db->getPdo());

$errors = [];
$success = "";


$pseudoValue = "";
$emailValue = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = trim($_POST["pseudo"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["password_confirm"]);

    $pseudoValue = $pseudo;
    $emailValue = $email;

    $validator = new FormValidator();

    $errors = $validator->validateRegister(
        $pseudo,
        $email,
        $password,
        $confirmPassword
    );

    if ($userRepo->pseudoExists($pseudo)) {
        $errors[] = "Pseudo déjà utilisé";
    }

    if (empty($errors)) {

        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);

        $user = new User(
            $pseudo,
            $email,
            $passwordHash
        );

        $userRepo->create($user);

        $success = "Inscription réussie ! Vous pouvez vous connecter.";
        
        
        $pseudoValue = "";
        $emailValue = "";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">

            <h1>Inscription</h1>

            <!-- ERREURS -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- SUCCESS -->
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <!-- FORMULAIRE -->
            <form method="post">

                <div class="mb-3">
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" class="form-control"
                           value="<?= htmlspecialchars($pseudoValue) ?>">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($emailValue) ?>">
                </div>

                <div class="mb-3">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Confirmation</label>
                    <input type="password" name="password_confirm" class="form-control">
                </div>

                <button class="btn btn-primary">S'inscrire</button>

            </form>

        </div>
    </div>
</div>

</body>
</html>