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

var_dump($_SESSION);
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validation du pseudo
    if (empty($_POST['pseudo']) || strlen($_POST['pseudo']) < 3) {
        $errors[] = "Le pseudo doit contenir au moins 3 caractères.";
    } elseif (isset($_SESSION['users'][$_POST['pseudo']])) {
        $errors[] = "Ce pseudo est déjà pris.";
    }

    // Validation de l'email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }

    // Validation du mot de passe
    if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // S'il n'y a pas d'erreurs, on enregistre l'utilisateur
    if (empty($errors)) {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_SESSION['users'][$_POST['pseudo']] = [
            'email' => $_POST['email'],
            'password' => $hashedPassword
        ];
        $success = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="">
        <input type="text" name="pseudo" placeholder="Votre pseudo" value="<?php if (isset($_POST['pseudo'])) echo $_POST['pseudo']; ?>"><br><br>
        <input type="email" name="email" placeholder="Votre email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"><br><br>
        <input type="password" name="password" placeholder="Votre mot de passe"><br><br>
        <input type="password" name="confirm_password" placeholder="Confirmez votre mot de passe"><br><br>
        <input type="submit" value="S'inscrire">
        <?php if (!empty($errors)) : ?>
            <ul style="color: red;">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($success) : ?>
            <p style='color: green;'>Inscription réussie !</p>
        <?php endif; ?>
    </form>
</body>

</html>