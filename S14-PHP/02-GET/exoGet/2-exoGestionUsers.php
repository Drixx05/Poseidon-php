<?php
session_start();


/* 

    EXERCICE GET : 
        Créer un tableau de gestion des utilisateurs back office 

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [users], insérer des données fictives d'utilisateurs, par exemple, id, prenom, nom, email (cet array va représenter le retour d'une requête de selection en base de données)
                3 - Créer une base de page html pour créer un tableau html représentant les utilisateurs présents dans votre array session
                4 - Rajouter une colonne "actions" dans laquelle vous insérerez des boutons de votre choix pour les actions "Voir" "Modifier" "Supprimer"
                5 - Créer une communication de votre choix par GET via ces boutons pour amener sur une ou plusieurs autres pages pour chaque bouton
                6 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/


if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['id' => 1, 'nom' => 'Dupont', 'email' => 'dupont@example.com'],
        ['id' => 2, 'nom' => 'Durand', 'email' => 'durand@example.com'],
        ['id' => 3, 'nom' => 'Martin', 'email' => 'martin@example.com'],
    ];
}

if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    $_SESSION['users'] = array_filter($_SESSION['users'], function ($user) {
        return $user['id'] != $_GET['id'];
    });
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>Gestion des utilisateurs</h1>

    <?php if (isset($_GET['action']) && $_GET['action'] === 'voir') : ?>
        <h2>Fiche de <?= $_GET['nom'] ?></h2>
        <p>Email : <?= $_GET['email'] ?></p>
        <a href="?" class="btn btn-secondary">Retour</a>

    <?php elseif (isset($_GET['action']) && $_GET['action'] === 'modifier') : ?>
        <h2>Modifier <?= $_GET['nom'] ?></h2>
        <input type="text" value="<?= $_GET['nom'] ?>" class="form-control mb-2">
        <input type="email" value="<?= $_GET['email'] ?>" class="form-control mb-2">
        <a href="?" class="btn btn-secondary">Retour</a>

    <?php else : ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['users'] as $user) : ?>
                    <tr>
                        <th><?= $user['id'] ?></th>
                        <td><?= $user['nom'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <a href="?action=voir&id=<?= $user['id'] ?>&nom=<?= $user['nom'] ?>&email=<?= $user['email'] ?>" class="btn btn-info">Voir</a>
                            <a href="?action=modifier&id=<?= $user['id'] ?>&nom=<?= $user['nom'] ?>&email=<?= $user['email'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="?action=supprimer&id=<?= $user['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>

<?php session_destroy(); ?>