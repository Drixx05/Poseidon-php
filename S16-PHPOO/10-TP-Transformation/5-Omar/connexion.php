<?php

require_once "autoload.php";

SessionManager::start();

$db = new Database();
$userRepo = new UserRepository($db->getPdo());

$error = "";
$success = "";
$pseudoValue = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = trim($_POST["pseudo"]);
    $password = trim($_POST["password"]);
    $pseudoValue = $pseudo;
    $user = $userRepo->findByPseudo($pseudo);

    if ($user && password_verify($password, $user["password"])) {
        unset($user["password"]);
        SessionManager::set("connected_user", $user);
        $success = "Connexion réussie";
    } else {
        $error = "Pseudo ou mot de passe incorrect";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <div class="col-md-5 mx-auto">

        <h1>Connexion</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label>Pseudo</label>
                <input type="text" name="pseudo" class="form-control"
                       value="<?= htmlspecialchars($pseudoValue) ?>">
            </div>
            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button class="btn btn-success">Se connecter</button>
        </form>

    </div>
</div>

</body>
</html>