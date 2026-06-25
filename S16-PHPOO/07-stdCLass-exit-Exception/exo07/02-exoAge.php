<?php

/* 

Exercice : Validation d'âge avec gestion des exceptions

Objectif : Créer un code qui demande à l'utilisateur de saisir son âge (au travers d'un form) pour accéder à une section réservée d'un site. Si l'âge est inférieur à 18 ans, lancer une exception et afficher un message d'erreur.

*/

class AgeException extends Exception
{
    public function __construct()
    {
        parent::__construct("Vous êtes trop jeune, revenez plus tard.");
    }
}

class AgeValidator
{
    public function validateAge($age)
    {
        if ($age < 18) {
            throw new AgeException();
        }
        return true;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["age"])) {
    $message = '';
    $age = (int)$_POST["age"];

    try {
        $ageValidator = new AgeValidator();
        $ageValidator->validateAge($age);
        $message = "Accès autorisé, bienvenue.";
    } catch (AgeException $e) {
        $message = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Est-ce que je suis vieux ?</title>
</head>

<body>
    <h1>Est-ce que je suis vieux ?</h1>

    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="age">Entrez votre âge :</label>
        <input type="number" name="age" id="age" required>
        <input type="submit" value="Valider">
    </form>
</body>

</html>