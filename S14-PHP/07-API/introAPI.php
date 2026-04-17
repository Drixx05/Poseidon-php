<?php

/* 

    API : Application Programming Interface 

    C'est un ensemble de règles qui permet à uen application d'accèder à des services ou des données d'une autre application.

    Par exemple, une API peut récupérer des données sur un autre site pour les interpréter sur mon site à moi.

    En PHP on peut utiliser des API pour récupérer ou envoyer des données à un autre serveur via des requêtes HTTP.

    On utilisera des fonctions telles que file_get_contents(). Généralement les API renvoient des réponses sous forme de fichiers JSON que l'on peut ensuite traiter en PHP 

    On va faire un test avec une API "Open Meteo"

    Cet API récupère des données météo partout dans le monde, on peut ensuite extraire les données du JSON récupéré

    // URL de l'API : https://open-meteo.com/

    // Une URL générée sur le site pour que l'on puisse la manipuler 
    // https://api.open-meteo.com/v1/forecast?latitude=48.8534&longitude=2.3488&hourly=temperature_2m&current=temperature_2m&forecast_days=1

*/

$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=48.8534&longitude=2.3488&hourly=temperature_2m&current=temperature_2m&forecast_days=1";


// $data contient la totalité des infos récupérées par l'API en fonction de la demande envoyée par le GET
// var_dump($data);

// Affichage des informations météo 


// On lance généralement nos appels API dans des blocs try/catch (à voir en orienté objet)
try {

    // Récupération du contenu JSON
    $response = file_get_contents($apiUrl);

    // var_dump($response);

    // Décodage du fichier JSON en array !
    $data = json_decode($response, true);


    // A partir de là je fais simplement mon interprétation de données
    if (isset($data["current"]["temperature_2m"])) {
        $temperature = $data["current"]["temperature_2m"];
        echo "La temperature actuelle à Paris est de $temperature degrés";
    } else {
        echo "Impossible de récupérer les données";
    }
} catch (Exception $e) {
    echo "Problème d'appel API";
}

// Petite API pour s'entrainer : CatFacts 