<?php

/* 

Exercice 3 : Gérer une simulation d'un mode de paiement via des classes, traits et interfaces


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

trait ValidationPaiement
{
    public function valider()
    {
        return "Details du paiement validés<br>";
    }
}


abstract class Paiements implements PaiementInterface
{
    use ValidationPaiement;

    protected float $montant;

    public function __construct(float $montant)
    {
        $this->montant = $montant;
    }

    abstract public function traiterPaiement();

    public function executerPaiement()
    {
        echo $this->valider();
        return $this->traiterPaiement();
    }
}

class PaiementVirement extends Paiements
{

    final public function traiterPaiement()
    {
        return "Paiement de $this->montant € par virement<br>";
    }
}

class PaiementCarte extends Paiements
{

    public function traiterPaiement()
    {
        return "Paiement de $this->montant € par carte<br>";
    }
}

// Appels : 

$carte = new PaiementCarte(100);
echo $carte->executerPaiement();


$virement = new PaiementVirement(100);
echo $virement->executerPaiement();
