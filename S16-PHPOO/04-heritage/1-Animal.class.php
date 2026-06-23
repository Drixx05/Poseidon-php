<?php 

/*

    1. Héritage simple 

    L'héritage est un concept important de la programmation orientée objet, permettant de créer des classes dérivées qui héritent des props et methods d'une classe parente.
    Cela permet de réutiliser du code et d'y ajouter des spécificités supplémentaires pour les enfants :) 

    Dans ces exemples, la classe Animal est considérée mère, et possède deux classes enfant, Chien et Chat, ils auront un comportement en commun défini par la classe Animal mais auront aussi leurs propres spécificités (méthode aboyer et miauler par ex)

    Attention à respecter un contexte cohérent dans l'héritage 
        C'est à dire il faut pouvoir dire que A est un B 
            un bateau est un vehicule
            un chien est un animal
            un admin est un user 


*/

class Animal 
{
    protected string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    public function seDeplacer()
    {
        echo "$this->nom se déplace.<br>";
    }
}

class Chien extends Animal // On mets en place l'héritage au travers du mot clé "extends" à partir de ce momemt, l'intégralité du contenu (props et methods) de la classe mère sont transmises à la classe fille. Cependant ! Il faut bien faire attention aux visibilités de ces éléments ! Uniquement les visibilités public et protected sont transmises à l'héritage 
{

    public function aboyer()
    {
        echo "$this->nom aboie : Wan wan wan!<br>";
    }
}

$chien1 = new Chien("Fifi");

var_dump($chien1);
$chien1->seDeplacer();
$chien1->aboyer();

class Chat extends Animal 
{
    public function miauler()
    {
        echo "$this->nom miaule : Nyan nyan !<br>";
    }
}

$chat1 = new Chat("Bisou");
var_dump($chat1);
$chat1->seDeplacer();
$chat1->miauler();