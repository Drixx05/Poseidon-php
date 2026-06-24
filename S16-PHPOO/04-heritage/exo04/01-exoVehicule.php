<?php


/*

       Exercice 1 : 
        Modifier le code des classes et mettre en place les héritages pour répondre aux questions ci-dessous : 

    1. Faire en sorte de ne pas avoir d'objet Vehicule
    2. Obligation pour la Renault et la Peugeot de posséder exactement la même méthode démarrer()
    3. Obligation pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence 
    4. La Renault doit effectuer 30 test de + qu'un véhicule de base 
    5. La Peugeot doit effectuer 70 test de + qu'un vehicule de base
    6. Effectuer les affichages nécessaires
*/



abstract class Vehicule
{

    final public function demarrer()
    {
        return 'je démarre';
    }

    abstract public function carburant();

    public function nombreDeTestObligatoire()
    {
        return 100;
    }
}

class Peugeot extends Vehicule
{
    public function carburant()
    {
        return "essence";
    }

    public function nombreDeTestObligatoire()
    {
        return parent::nombreDeTestObligatoire() + 70; // 100 + 70
    }
}

class Renault extends Vehicule
{
    public function carburant()
    {
        return "diesel";
    }

    public function nombreDeTestObligatoire()
    {
        return parent::nombreDeTestObligatoire() + 30; // 100 + 30
    }
}

$peugeot = new Peugeot;
$carburantPeugeot = $peugeot->carburant();

$renault = new Renault;
$carburantRenault = $renault->carburant();
$tests_renault = $renault->nombreDeTestObligatoire();
$tests_peugeot = $peugeot->nombreDeTestObligatoire();