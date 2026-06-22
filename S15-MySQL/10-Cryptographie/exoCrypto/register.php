<?php
session_start();

include __DIR__ . "/../../09-PDO/config.php";

// --- Connexion PDO ---
$dsn = "mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=crypto;charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

// --- Chargement de la clé de chiffrement ---
$keyRaw = file_get_contents(__DIR__ . '/key.txt');
$key    = base64_decode(trim($keyRaw));
$cipher = 'aes-256-cbc';

// --- État de la page ---
$error          = '';
$successMessage = '';
$decryptedEmail = '';
$registered     = false;

// --- Traitement du formulaire ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pseudo'], $_POST['email'], $_POST['password'])) {

    $pseudo   = trim($_POST['pseudo']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 1. Vérification doublon sur le pseudo
    $stmtCheck = $pdo->prepare('SELECT id_membre FROM membre WHERE pseudo = :pseudo');
    $stmtCheck->execute([':pseudo' => $pseudo]);

    if ($stmtCheck->fetch()) {
        $error = "Ce pseudo est déjà utilisé.";
    } else {

        // 2. Hashage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

        // 3. Chiffrement de l'email
        $ivLength       = openssl_cipher_iv_length($cipher);
        $iv             = random_bytes($ivLength);
        $encryptedEmail = openssl_encrypt($email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $storedEmail    = base64_encode($iv . $encryptedEmail);

        // 4. Insertion en BDD
        $stmtInsert = $pdo->prepare(
            'INSERT INTO membre (pseudo, email, password) VALUES (:pseudo, :email, :password)'
        );
        $stmtInsert->execute([
            ':pseudo'   => $pseudo,
            ':email'    => $storedEmail,
            ':password' => $hashedPassword,
        ]);

        // 5. Déchiffrement de l'email pour la confirmation
        $decoded        = base64_decode($storedEmail);
        $ivExtracted    = substr($decoded, 0, $ivLength);
        $encryptedPart  = substr($decoded, $ivLength);
        $decryptedEmail = openssl_decrypt($encryptedPart, $cipher, $key, OPENSSL_RAW_DATA, $ivExtracted);

        $successMessage = "Vous êtes bien inscrit !";
        $registered     = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background-color: #4f46e5;
            color: white;
            border-radius: 12px 12px 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            width: 100%;
            padding: .65rem;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <?php if ($registered): ?>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">✅ Inscription confirmée</h5>
                        </div>
                        <div class="card-body text-center">
                            <p class="text-muted mb-1">Bienvenue ! Votre compte a bien été créé.</p>
                            <p class="mb-4">Adresse email enregistrée : <strong><?= htmlspecialchars($decryptedEmail) ?></strong></p>
                            <a href="register.php" class="btn btn-primary">Créer un autre compte</a>
                        </div>
                    </div>

                <?php else: ?>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Créer un compte</h5>
                        </div>
                        <div class="card-body">

                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="pseudo" class="form-label fw-semibold">Pseudo</label>
                                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Votre pseudo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="exemple@mail.com" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                                </div>
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </form>

                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>