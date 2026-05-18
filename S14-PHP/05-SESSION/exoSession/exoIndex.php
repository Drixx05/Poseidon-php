<?php 


session_start();

// Produits disponibles
$products = [
    ['id' => 1, 'name' => 'Produit 1', 'price' => 19.99],
    ['id' => 2, 'name' => 'Produit 2', 'price' => 24.99],
    ['id' => 3, 'name' => 'Produit 3', 'price' => 15.99],
    ['id' => 4, 'name' => 'Produit 4', 'price' => 29.99],
];

// Ajout au panier
if (isset($_GET['add_to_cart'])) {
    $productId = intval($_GET['add_to_cart']);
    $foundProduct = null;

    // Recherche du produit dans la liste
    foreach ($products as $product) {
        if ($product['id'] === $productId) {
            $foundProduct = $product;
            break;
        }
    }

    if ($foundProduct) {
        // Ajout dans le panier (gestion des quantités)
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = [
                'name' => $foundProduct['name'],
                'price' => $foundProduct['price'],
                'quantity' => 1
            ];
        }
        $_SESSION['message'] = "Le produit a été ajouté au panier.";
    }
    header('Location: exoIndex.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des Produits</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text">Prix : <?= $product['price'] ?>€</p>
                            <a href="exoIndex.php?add_to_cart=<?= $product['id'] ?>" class="btn btn-primary">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="exoPanier.php" class="btn btn-info mt-3">Voir le panier</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
