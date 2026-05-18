<?php

// Test technique : 

// EXERCICE : 
//  ----------------------------------
/*

// API StarWars : SWAPI : https://swapi.dev/

    - Créer un formulaire permettant de faire une recherche de personnages via l'API Star Wars selon les informations saisies dans un champ de texte.

    - Le nom des personnages récupérés seront affichés sous forme de liste.

    - Chaque élément de la liste sera cliquable

    - Lorsqu'on clique sur un élément de la liste, les informations du personnage associé s'afficheront en dessous de celui-ci. 

    - Les informations à afficher sont : la taille, le poids, la couleur des cheveux, la couleur des yeux, l'année de naissance, le genre

    - Bonus : Afficher le nom de la planète d'origine

*/

// Fonction pour appeler l'API SWAPI
function getSWChar($char)
{
    $char = urlencode($char);
    $url = "https://swapi.dev/api/people/?search=" . $char; // API publique basé sur StarWars
    $response = file_get_contents($url);
    if ($response !== false) {
        $data = json_decode($response, true);
        return $data;
    }
    return "Aucun personnage trouvé";
}

$character = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["char"])) {
    $characters = getSWChar($_POST["char"]);
    // var_dump($characters);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnage SW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Recherchez un personnage star wars</h1>
                <form method="POST" class="text-center">
                    <div class="mb-3">
                        <label for="char" class="form-label">Nom de personnage</label>
                        <input type="texte" class="form-control" id="char" name="char" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>

                <?php if (!empty($characters)): ?>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Voici les informations trouvées :</h5>
                            <ul class="list-group">
                                <?php
                                $i = 1;
                                foreach ($characters["results"] as $character):
                                    $response = file_get_contents($character["homeworld"]);
                                    if ($response !== false) :
                                        $data = json_decode($response, true);
                                        $planet = $data["name"];
                                    // var_dump($data);
                                    endif;
                                ?>

                                    <li class="list-group-item" data-bs-toggle="modal" data-bs-target="#modal<?= $i ?>"><strong><?= $character["name"] ?></strong></li>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal<?= $i ?>" tabindex="-1" aria-labelledby="modal<?= $i ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal<?= $i ?>Label">Infos de <?= $character["name"] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Taille :</b> <?= $character["height"] ?>, <b>Poids :</b> <?= $character["mass"] ?>, <b>Couleur des cheveux :</b> <?= $character["hair_color"] ?>, <b>Couleur des yeux :</b> <?= $character["eye_color"] ?>, <b>Année de naissance :</b> <?= $character["birth_year"] ?>, <b>Genre :</b> <?= $character["gender"] ?>, <b>Planete :</b> <?= $planet ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php
                                    $i++;
                                endforeach;  ?>

                            </ul>
                            <p class="card-text"></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>