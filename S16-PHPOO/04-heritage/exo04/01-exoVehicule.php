<?php


/*

       Exercice 1 : 
        Modifier le code des classes et mettre en place les héritages pour répondre aux questions ci-dessous : 

    1. Faire en sorte de ne pas avoir d'objet Vehicule (abstract sur class Vehicule bloque l'instanciation)
    2. Obligation pour la Renault et la Peugeot de posséder exactement la même méthode démarrer() (final sur la méthode commme ça on préserve son comportement)
    3. Obligation pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence (abstract sur la méthode oblige la redéfinition)
    4. La Renault doit effectuer 30 test de + qu'un véhicule de base 
    5. La Peugeot doit effectuer 70 test de + qu'un vehicule de base
    6. Effectuer les affichages nécessaires
*/



abstract class Vehicules
{

    final public function demarrer()
    {
        return 'je démarre';
    }

    abstract public function carburant();

    public function nombreDeTestObligatoire()
    {
        return 500;
    }
}

class Peugeot extends Vehicules
{
    public function carburant()
    {
        return "essence";
    }

    public function nombreDeTestObligatoire()
    {
        return parent::nombreDeTestObligatoire() + 70;
    }
}

class Renault extends Vehicules
{
    public function carburant()
    {
        return "diesel";
    }

    public function nombreDeTestObligatoire()
    {
        return parent::nombreDeTestObligatoire() + 30;
    }
}

$peugeot1 = new Peugeot();
$renault1 = new Renault();

echo $peugeot1->demarrer();
echo $renault1->demarrer();

echo $peugeot1->carburant();
echo $renault1->carburant();

echo $peugeot1->nombreDeTestObligatoire();
echo $renault1->nombreDeTestObligatoire();
