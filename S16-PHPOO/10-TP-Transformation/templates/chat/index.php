<?php
/** @var \App\Chat\Domain\Entities\Message[] $messages */
/** @var array $errors */
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
        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5">Poster un message</h2>
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="/chat">
                            <div class="mb-3">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input type="text"
                                    class="form-control"
                                    id="pseudo"
                                    value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="content" rows="3" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php $count = count($messages); ?>
                        <h2 class="card-title h5">Messages : <?= $count ?></h2>
                        <?php foreach ($messages as $msg) : ?>
                            <div class="mb-3">
                                <strong><?= htmlspecialchars($msg->authorName) ?></strong> a posté le
                                <small class="text-muted"><?= (new DateTime($msg->createdAt))->format('d/m/Y à H:i') ?> :</small>
                                <p><?= htmlspecialchars($msg->content) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>