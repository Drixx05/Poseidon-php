<?php

/*

    EXERCICE SESSION :
            Page de produits et ajout panier + page panier : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un array $products qui contient des produits fictifs (id, name, price)
                    - 3 Afficher ces produits sur la page avec un bouton Ajout panier géré avec GET 
                    - 4 Traiter le GET pour récupérer les informations produits et l'ajouter à $_SESSION['cart'] ainsi qu'un indice "quantity"
                    - 5 Traiter le fait que ce produit est peut être déjà présent en ajoutant simplement 1 à la quantité déjà présente
                    - 6 Vérifier le contenu de la session
                    - 7 Créer une page panier.php dans laquelle seront affichés les produits présents dans le panier avec un calcul du prix en rapport à leur quantité, prix par produit, prix total 
                    - 8 Permettre de modifier la quantité produit dans le panier 
                    - 9 Permettre de supprimer un produit du panier
                    - 10 Permettre de vider le panier entier 

*/ 

session_start();
$products= [
    ['id' => 1, 'name' => "Crimson Desert", 'price' => 69.99],
    ['id' => 2, 'name' => "Zelda: Ocarina of Time", 'price' => 120.00],
    ['id' => 3, 'name' => "Chrono Trigger", 'price' => 80.00],
    ['id' => 4, 'name' => "Final Fantasy VII", 'price' => 50.00],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Game Store</title>
</head>
<body>
    <div class="container">
        <h1>Video Game Store</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text"><?= $product['price'] ?> €</p>
                            <a href="?add=<?= $product['id'] ?>" class="btn btn-primary">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>