<?php

/*

    EXERCICE POST :
            Formulaire connexion utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une connexion utilisateur (pseudo, password)
                    - 3 Controler ces informations reçues dans POST pour un contexte de connexion, c'est à dire de vérifier si l'utilisateur existe bien, et dans un second temps de vérifier la correspondance du mot de passe saisi avec le mot de passe crypté via la fonction password_verify()
                    - 4 Si tout est ok, afficher un message à l'utilisateur et stocker dans $_SESSION['connected_user']  les informations de l'utilisateur actuellement connecté
                    - 5 Si pas ok, afficher un message d'erreur indiquant que la saisie est incorrecte

*/

session_start();
$errors = [];
$success = false;
$pseudo = "";
$password = "";

if (($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["pseudo"], $_POST["password"])) {

    $pseudo = trim($_POST["pseudo"]);
    $password = trim($_POST["password"]);
    if (empty($pseudo) || empty($password)) {
        $errors[] = "Tous les champs sont requis.";
    } elseif (!isset($_SESSION['users'][$pseudo]) || !password_verify($password, $_SESSION['users'][$pseudo]['password'])) {
        $errors[] = "Wrong credentials";
    } else {
        $_SESSION['connected_user'] = [
            'pseudo' => $pseudo,
            'email' => $_SESSION['users'][$pseudo]['email']
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
        <input type="text" name="pseudo" placeholder="Votre pseudo"><br><br>
        <input type="password" name="password" placeholder="Votre mot de passe"><br><br>
        <input type="submit" value="Se connecter">
    </form>
    <?php if (!empty($errors)) : ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($success) : ?>
        <p style='color: green;'>Connexion réussie ! Bienvenue <?= $_SESSION['connected_user']['pseudo'] ?>.</p>
    <?php endif; ?>
</body>

</html>