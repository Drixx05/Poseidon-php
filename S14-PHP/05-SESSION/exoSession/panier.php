<?php
session_start();
$total = 0;


if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    unset($_SESSION['cart']);
}

if (isset($_GET['action'], $_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'add') {
        $_SESSION['cart'][$id]['quantity']++;
    } elseif ($action === 'remove') {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']--;
            if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
    } elseif ($action === 'delete') {
        unset($_SESSION['cart'][$id]);
    } else {
        $error = "Une erreur est survenue.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container my-5">
        <h1>Cart</h1>
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total For Product</th>
                    </tr>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?= $item['product']['name'] ?></td>
                            <td><a href="?action=delete&id=<?= $item['product']['id'] ?>" class="btn btn-danger btn-sm">Delete</a> <a href="?action=remove&id=<?= $item['product']['id'] ?>" class="btn btn-warning btn-sm">-</a><?= $item['quantity'] ?><a href="?action=add&id=<?= $item['product']['id'] ?>" class="btn btn-success btn-sm">+</a></td>
                            <td><?= $item['product']['price'] ?> €</td>
                            <td> <?= $item['product']['price'] * $item['quantity'] ?> €</td>
                            <?php $total += $item['product']['price'] * $item['quantity']; ?>
                        </tr>
                    <?php endforeach; ?>
            </table>
            <p>Total: <?= $total ?> €</p>
            <a href="?action=clear" class="btn btn-outline-danger">Remove All Products From The Cart</a>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>
    </div>
</body>

</html>