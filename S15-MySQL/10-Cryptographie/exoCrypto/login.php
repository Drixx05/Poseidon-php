<?php
session_start();

include __DIR__ . "/../../09-PDO/config.php";

$dsn = "mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=crypto;charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pseudo'], $_POST['password'])) {

    $pseudo   = trim($_POST['pseudo']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare('SELECT * FROM membre WHERE pseudo = :pseudo');
    $stmt->execute([':pseudo' => $pseudo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['connected_user'] = [
            'pseudo' => $user['pseudo'],
            'email'  => $user['email'],
        ];
        header('Location: ../../09-PDO/09-TP-tchat.php');
        exit;
    } else {
        $error = "Pseudo ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        .card-body { padding: 2rem; }
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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Connexion</h5>
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
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>

                    <p class="text-center text-muted mt-3 mb-0">
                        Pas encore de compte ? <a href="register.php">S'inscrire</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>