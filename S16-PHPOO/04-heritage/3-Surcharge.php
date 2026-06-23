<?php 

/*

    Surcharge / Override 

    La surcharge est le concept qu'une classe enfant de réécrive une méthode héritée de la classe parente afin de modifier son comportement 

*/

class Animal 
{
    public string $nom;

    public function __construct(string $nom) 
    {
        $this->nom = $nom;
    }

    public function seDeplacer() 
    {
        echo "$this->nom se déplace.<br>";
    }
}

class Oiseau extends Animal 
{
    public function seDeplacer() // On redéfinit la méthode seDeplacer, on est en train de mettre en place une surcharge/override 
    {
        echo "$this->nom vole dans les airs.<br>"; // On écrase en fait la méthode d'origine pour appliquer un nouveau traitement 
        // echo parent::seDeplacer(); // Il nous est toujours possible de réatteindre la méthode parent grâce à la syntaxe parent::seDeplacer();
    }
}

$oiseau1 = new Oiseau("Yuzo");

$oiseau1->seDeplacer();