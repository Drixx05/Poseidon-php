<?php 

/*

    1 - stdClass : L'objet generique en PHP

    En PHP, la classe stdClass est une classe générique utilisée pour créer des objets simples contenant uniquement de la data. 
    On l'utilise lorsqu'on préfère utiliser un objet plutot qu'un array 

    Egalement ce sont des objets stdClass que vous  récupérez sur des casting de type ainsi que sur des generations de data automatique 

*/

// Création d'un objet stdClass 
$objet = new stdClass();
$objet->nom = "Pierro";
$objet->mail = "pierro@mail.com";

echo $objet->nom;
var_dump($objet);


// Ici un array
$array = ["nom" => "Bob", "adresse" => "BikiniBottom"];

var_dump($array);

// Conversion en objet ! 
$obj = (object) $array;
var_dump($obj);

// Pareil, si j'utilise PDO et que je fetch, lors d'un FETCH_OBJ, je récupère aussi du stdClass 

?>