<?php

/* 

Exercice 2 : Gérer une simulation d'un mode de paiement via des classes, traits et interfaces


Énoncé :

    Créer une interface PaiementInterface avec une méthode executerPaiement().
    Créer une classe abstraite Paiement qui implémente cette interface, avec une méthode abstraite traiterPaiement().
    Créer deux classes PaiementCarte et PaiementVirement qui héritent de Paiement et implémentent la méthode abstraite.
    Utiliser un trait ValidationPaiement avec une méthode valider() qui vérifie les détails du paiement avant de l'exécuter.
    Dans une des classes (par exemple PaiementCarte), empêchre la surcharge d'une méthode en la marquant comme final.


    */

interface PaiementInterface
{
    public function executerPaiement();
}

abstract class Paiement implements PaiementInterface
{
    abstract function traiterPaiement();
}

trait ValidationPaiement
{
    public function valider()
    {
        echo "Votre paiement est valide , ou non.<br>";
    }
}

class PaiementCarte extends Paiement
{
    use ValidationPaiement;

    public function executerPaiement()
    {
        $this->valider();
        $this->traiterPaiement();
    }

    final public function traiterPaiement()
    {
        echo "Paiement effectué.<br>";
    }
}

class PaiementVirement extends Paiement
{
    use ValidationPaiement;

    public function executerPaiement()
    {
        $this->valider();
        $this->traiterPaiement();
    }

    public function traiterPaiement()
    {
        echo "Veuillez renseigner les coordonnées bancaires.<br>";
    }
}
