<?php
include __DIR__ . "/config.php";

$dsn = "mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=" . $DB_NAME;
$login = $DB_USER;
$password = $DB_PASS;
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];

try {
    $pdo = new PDO($dsn, $login, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $erreurs = [];



    if (mb_strlen($pseudo) < 3) {
        $erreurs[] = "Le pseudo doit faire au moins 3 caractères.";
    } else if (mb_strlen($pseudo) > 20) {
        $erreurs[] = "Le pseudo ne doit pas dépasser 20 caractères.";
    }

    if (mb_strlen($message) < 2) {
        $erreurs[] = "Le message doit faire au moins 2 caractères.";
    } elseif (mb_strlen($message) > 500) {
        $erreurs[] = "Le message ne doit pas dépasser 500 caractères.";
    }

    if (empty($erreurs)) {
        $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (?, ?, NOW())");
        $stmt->execute([$pseudo, $message]);
    }
}

$stmt = $pdo->prepare("SELECT pseudo, message, date_enregistrement FROM commentaire ORDER BY date_enregistrement DESC");
$stmt->execute(); 
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tchat en ligne</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tchat en ligne</h1>
        <div class="row">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5">Poster un message</h2>
                        <?php if (!empty($erreurs)) : ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($erreurs as $erreur) : ?>
                                        <li><?= htmlspecialchars($erreur) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input type="text" class="form-control w-25" id="pseudo" name="pseudo" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                        </form>
                </div>
            </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php $count = count($messages); ?>
                        <h2 class="card-title h5">Messages : <?= $count ?></h2>
                        <?php foreach ($messages as $msg) : ?>
                            <div class="mb-3">
                                <strong><?= htmlspecialchars($msg['pseudo']) ?></strong> à posté le <small class="text-muted"><?= (new DateTime($msg['date_enregistrement']))->format('d/m/Y à H:i') ?> : </small>
                                <p><?= htmlspecialchars($msg['message']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php /*

EXERCICE TP Tchat en ligne : 
-------------------------------

- Création d'un tchat en ligne 


-- ETAPES : 

- 01 - Création de la BDD : dialogue 
    - Table : commentaire 
    - Champs de la table commentaire : 
        - id_commentaire        INT PK AI
        - pseudo                VARCHAR
        - message               TEXT
        - date_enregistrement   DATETIME

- 02 - Créer une connexion à cette base avec PDO


- 03 - Création d'un formulaire html permettant de poster un message 
    - Champs du formulaire : 
        - pseudo (input text)
        - message (text area)
        - bouton submit

- 04 - Récupération des saisies du form avec controle (pseudo et message pas vide, pseudo pas trop court pas trop long, message pas trop court pas trop long etc)


- 05 - Déclenchement d'une requête d'enregistrement pour enregistrer les saisies dans la BDD

- 06 - Requête de récupération des messages afin de les afficher dans cette page 

- 07 - Affichage des messages avec un peu de mise en forme 

- 08 - Affichage en haut des messages du nombre de messages présents dans la BDD

- 09 - Affichage de la date formatée en français 

- 10 - Amélioration CSS

*/