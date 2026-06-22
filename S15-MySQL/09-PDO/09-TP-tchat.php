<?php
session_start();
include __DIR__ . "/config.php";
if (!isset($_SESSION['connected_user'])) {
    header('Location: ../10-Cryptographie/exoCrypto/login.php');
    exit;
}
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
                            <input type="text"
                                class="form-control"
                                id="pseudo"
                                name="pseudo"
                                value="<?= htmlspecialchars($_SESSION['connected_user']['pseudo']) ?>"
                                readonly>
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

// Pour éviter les injections XSS (du code css et/ou js mis dans les commentaires)
// il est possible de modifier les carac notamment les < > qui représentent des balises.
// à l'affichage (voir en bas de page) on appelle htmlspecialchars() qui permet de transformer ces caractères problématiques en entités html
// exemple :
// <script>while(true){alert('truc');}</script>
// sera écrit dans le code source sous cette forme :
// &lt;script&gt;while(true){alert('truc');}&lt;/script&gt;

// <style>body{display:none;}</style>

// Outils proche de htmlspecialchars() : htmlentities() / strip_tags()

// Pour tester les injections, depuis le champ message 
// pour injection SQL ', ''); DROP DATABASE dialogue;

// ', '', NOW()); DO SLEEP(10);  injection en aveugle, permet de voir si l'injection est possible en mettant un temps de délais à la requete (on remarque le chargement, comme ça, même sans message d'erreur on peut comprendre que le système est sensible aux injections)

// Pour insérer dans un fichier.txt   la selection d'une table via injection 
// ', NOW()); SELECT * INTO OUTFILE 'c:/wamp64/tmp/fichier2.txt' FROM commentaire; #

// Pour réinsérer dans une table, le contenu d'un fichier.txt 
// ', NOW()); INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('1', LOAD_FILE('c:/wamp64/tmp/fichier2.txt'), NOW());

// Ici dans ce fichier on manipule uniquement la table commentaire, mais lorsqu'un form est sensible aux injections, c'est l'entiereté de la base qui est compromise !!!
// Notre form devient une vraie console mysql et libre au user pirate d'exécuter les requêtes de son choix, même sur d'autres tables de notre base, par exemple pour récupérer les infos de nos users ! 

EXERCICE TP Tchat en ligne : 
-------------------------------

- Création d'un tchat en ligne 


-- ETAPES : 

- 01 - Création de la BDD : dialogue   (Fait dans PHPMyAdmin)
    - Table : commentaire 
    - Champs de la table commentaire : 
        - id_commentaire        INT PK AI
        - pseudo                VARCHAR
        - message               TEXT
        - date_enregistrement   DATETIME

*/


// - 02 - Créer une connexion à cette base avec PDO  
$dsn = "mysql:host=localhost;dbname=dialogue"; // service - host - bdd 
$login = "root"; // le login bdd
$password = "";  // le password du login (rien sur wamp, attention sur mamp c'est "root" ou le password que vous avez défini sur vos stacks)
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On mets les Erreurs en warning pour pouvoir les afficher ! 
);

// Création de l'objet PDO : 

try {
    $pdo = new PDO($dsn, $login, $password, $options); // Instanciation d'un objet PDO
} catch (PDOException $e) {
    echo "Erreur de BDD";
    exit;
}

// Si l'instanciation de l'objet s'est bien passé, je récupère un objet PDO et donc la connexion à la BDD a fonctionné ! 
// var_dump($pdo);

$pseudo = "";
$message = "";
$errors = array();
$req = "";

// var_dump($_POST); // Ok je récupère tout bien dans mon $_POST

// - 04 - Récupération des saisies du form avec controle (pseudo et message pas vide, pseudo pas trop court pas trop long, message pas trop court pas trop long etc)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pseudo = trim($_POST["pseudo"]);
    $message = trim($_POST["message"]);

    // Contrôles de validation
    // Champs obligatoires 
    if (empty($pseudo) || empty($message)) {
        $errors[] = "Tous les champs sont requis";
    }

    // Pseudo trop court ou trop long
    if (iconv_strlen($pseudo) < 4 || iconv_strlen($pseudo) > 20) {
        $errors[] = "Le pseudo doit faire entre 4 et 20 caractères";
    }

    // Message trop court 
    if (iconv_strlen($message) < 3) {
        $errors[] = "Le message doit faire au moins 3 caractères";
    }

    // - 05 - Déclenchement d'une requête d'enregistrement pour enregistrer les saisies dans la BDD
    if (empty($errors)) { // Si je n'ai pas d'erreur, c'est bon !
        $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
        // Soit avec query... ???!!!
        // $stmt = $pdo->query($req);

        // Sinon avec prepare ! (Mieux pour la sécurité pour éviter les injections)
        $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
        $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);
        $stmt->execute();

        // Pour éviter de renvoyer une nouvelle fois le form à l'actualisation de la page, on fait un refresh de page grace à une redirection vers la meme page
        // header("location:09-TP-tchat.php");

    }
}

// - 06 - Requête de récupération des messages afin de les afficher dans cette page 
$stmt = $pdo->prepare("SELECT id_commentaire, pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y à %T') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC); // Grâce à fetchAll() je récupère la totalité des messages
$nbMessages = sizeof($messages); // Ici je compte le nombre d'éléments dans le array $messages c'est à dire le nombre de messages ! 
// var_dump($messages);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Playfair display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>

    <title>TP Tchat</title>
</head>

<body class="bg-secondary">
    <div class="container bg-light g-0">
        <div class='row '>
            <div class="col-12">
                <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de Tchat <i class="far fa-comments"></i></h2>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <!-- - 03 - Création d'un formulaire html permettant de poster un message  -->
                <form method="POST" class="mt-5 mx-auto w-50 border p-3 bg-white">
                    <!-- Affichage de la requête lancée -->
                    <?= $req ?>
                    <hr>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo <i class="fas fa-user-alt"></i></label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo ?>">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message <i class="fas fa-feather-alt"></i></label>
                        <textarea class="form-control" id="message" name="message"><?= $message ?></textarea>
                    </div>
                    <div class="mb-3">
                        <hr>
                        <button type="submit" class="btn btn-secondary w-100" id="enregistrer" name="enregistrer"><i class="fas fa-keyboard"></i> Enregistrer <i class="fas fa-keyboard"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class='row mt-5'>
            <div class="col-12">
                <p class="w-75 mx-auto mb-3">Il y a : <b><?= $nbMessages ?></b> messages</p>
                <!-- - 07 - Affichage des messages avec un peu de mise en forme  -->
                <?php foreach ($messages as $message): ?>
                    <div class="card w-75 mx-auto mb-3">
                        <div class="card-header bg-dark text-white">
                            Par : <?= htmlspecialchars($message["pseudo"]) ?>, le : <?= htmlspecialchars($message["date_fr"]) ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($message["message"]) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>