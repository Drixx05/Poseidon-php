<?php

// Ici superglobale $_SERVER qui me permet d'avoir accès à certaines informations notamment pour voir que la REQUEST_METHOD par defaut (le mode de communication client/serveur) est la méthode GET 
// var_dump($_SERVER);

// Le protocole GET fait partie du protocole HTTP, utilisé pour récupérer des informations depuis un serveur.
// C'est l'une des méthodes les plus courants pour intéragir avec une application web

// Tout transite au niveau de l'URL !!

// Par exemple pour une adresse ci dessous : 
// www.monsite.com/product.php?id=456  
// On demande une page product.php mais en transmettant un param supplémentaire ici un id produit, donc id = 456
// On va être en PHP capable de récupérer cet id produit pour déclencher un traitement spécifique

// Puisque les informations transmises par GET sont visibles dans l'url du site, on évitera d'y transmettre des informations sensibles comme les mot de passe notamment 

// Quelques cas d'utilisation de GET : 

// Affichage variable sur une page template 
// Gestion d'action sur une page de gestion : modifier/supprimer/voir 

// En PHP on va récupérer ces informations présentes dans l'url dans ce qu'on appelle une superglobale !

// Une superglobale c'est quoi ? C'est une sorte de variable toujours présente dans n'importe quel scope, qui contient des informations variées, ici ce sera $_GET  qui contiendra les informations présentes dans l'url sous forme de clé valeur donc.... C'est un tableau ARRAY ! Comme toutes les autres superglobales 

// On considèrera qu'on utilise le process avec GET dès lors que l'on a une action qui se déclenche au "clic" 

var_dump($_GET);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="introGET.php">Eshop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="introGET.php">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?cat=info">Informatique</a></li>
                            <li><a class="dropdown-item" href="?cat=emen">Electro-Menager</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="?cat=vet">Vêtements</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container pt-5">
        <?php
        if (isset($_GET["cat"])) {
             echo "Voici les produits de la catégorie : " . $_GET["cat"];
        } else {
            echo "<h2>Choisissez une catégorie</h2>";
        }
           
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>