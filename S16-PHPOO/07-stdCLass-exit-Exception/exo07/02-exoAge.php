<?php 

/* 

Exercice : Validation d'âge avec gestion des exceptions

Objectif : Créer un code qui demande à l'utilisateur de saisir son âge (au travers d'un form) pour accéder à une section réservée d'un site. Si l'âge est inférieur à 18 ans, lancer une exception et afficher un message d'erreur.

*/

var_dump($_POST);

class Validateur
{
    public static function verifierAge(int $age): mixed
    {
        if ($age < 18) {
            throw new Exception("Vous devez avoir au moins 18 ans.");
        } else {
            return true;
        }
    }
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['age']) && $_POST['age'] !== '' && is_numeric($_POST['age'])) {
            $age =  (int) $_POST['age'];
            Validateur::verifierAge($age);

            $message = "Accès accordé, vous avez " . $age . " ans.";
        } else {
            $message = "Veuillez saisir votre âge.";
        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Validation Age</title>
</head>

<body>
    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="age">Votre âge :</label>
        <input type="number" name="age" id="age" required>
        <input type="submit" value="Valider">
    </form>
</body>

</html>