<?php 

/* 

    Classes abstract et methodes abstract 

    Une classe abstract ne peut pas être instanciée directement, elle sert uniquement de modèle pour d'autres classes.

    Une classe abstract contient généralement des méthodes déclarées elles aussi abstract, cela oblige les classes filles à définir la méthode en question.

    Dans l'exemple ci dessous, la méthode communiquer() étant abstract, la classe Chien et Chat ont l'OBLIGATION d'implémenter cette méthode (ou bien de la définir à nouveau en abstract pour l'appliquer à un nouveau niveau d'héritage)

    L'utilisation des classes abstraites permet de fournir un cadre strict de dév ! Grâce à ça, tous les devs de l'équipe travaillant sur les classes et sous classe vont automatiquement travailler de la même manière en utilisant les bons noms de méthodes prévus par la classe principale abstract  

*/


abstract class Animals // Ici je défini ma classe comme étant une classe abstract, je ne peux plus l'instancier ! Je peux uniquement m'en servir pour un héritage
{
    public string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    abstract public function communiquer();
}

// $animal1 = new Animals("Titi");
// $animal1->communiquer();

class Chien extends Animals 
{
    public function communiquer() 
    {
        echo "$this->nom aboie: Woof !<br>";
    }
}

class Chat extends Animals 
{
    public function communiquer()
    {
        echo "$this->nom miaule : Miaou !<br>";
    }
}