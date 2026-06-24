<?php 

class Ecole 
{
    public $nom = "CloudCampus";
    public $ville = "Paris";

    public function __clone()
    {
        // Un clone peut se faire sans forcément définir la méthode magique (voir plus bas) Mais si elle existe, alors le code que l'on exécute ici s'appliquera au nouvel objet créé.
        $this->nom = "Nom Inconnu";
    }
}

$ecole1 = new Ecole;
$ecole2 = new Ecole;
$ecole2->ville = "Lille";

var_dump($ecole1);
var_dump($ecole2);

$ecole3 = $ecole1; // Lorsque je fais ça, je pensais faire une copie d'un élément vers un nouvel élément, MAIS NON ! En fait je créer ici simplement une nouvelle variable ecole3 représentant le MEME objet que ecole1 donc lorsque j'appelle ecole3 ou ecole1, en fait, on parlera toujours du même objet #1 
// On comprends l'id de nos objets en faisant un var_dump
// On peut parfois avoir des incohérences en cours de développement avec ce genre de problématique, notamment lorsqu'il existe des patterns de limitation d'instanciation d'objet, tel que le pattern Singleton

$ecole4 = clone($ecole1);

// Dans ce cas d'origine, il n'existe que deux objets Ecole, le #1 représenté par $ecole1 et $ecole3 et le #2 représenté par $ecole2 
// var_dump($ecole3);
$ecole3->nom = "Pierra Formation";

var_dump($ecole3);
var_dump($ecole4);


// $ecole1->nom = "Formation de formation";


echo "<h2>Récap des écoles : </h2><br>";

echo "<b>Ecole 1 :</b> $ecole1->nom à $ecole1->ville <hr>"; 
echo "<b>Ecole 2 :</b> $ecole2->nom à $ecole2->ville <hr>"; 
echo "<b>Ecole 3 :</b> $ecole3->nom à $ecole3->ville <hr>"; 
echo "<b>Ecole 4 :</b> $ecole4->nom à $ecole4->ville <hr>"; 