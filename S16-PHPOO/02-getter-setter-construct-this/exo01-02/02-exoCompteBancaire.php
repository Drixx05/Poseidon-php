<?php

/* 

EXERCICE : 
            Création d'une classe CompteBancaire selon la modélisation suivante 

    ----------------------
    |   CompteBancaire   |
    ----------------------
    | -titulaire:string  |
    | -solde:float       |
    ----------------------
    | +__construct()     |
    | +getTitulaire()    |
    | +setTitulaire()    |
    | +getSolde()        |
    | +setSolde()        |
    | +afficherSolde()   |
    | +retirer()         |
    | +deposer()         |
    ----------------------

*/

class CompteBancaire
{
    private string $titulaire;
    private float $solde;

    public function __construct(string $titulaire, float $solde)
    {
        $this->setTitulaire($titulaire);
        $this->setSolde($solde);
    }

    public function getTitulaire(): string
    {
        return $this->titulaire;
    }

    public function setTitulaire(string $titulaire): void
    {
        if (iconv_strlen($titulaire, 'UTF-8') < 3 || iconv_strlen($titulaire, 'UTF-8') > 20) {
            throw new Exception("Le nom du titulaire doit être entre 3 et 20 caractères.");
        } else {
            $this->titulaire = $titulaire;
        }
    }

    public function getSolde(): float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): void
    {
        if ($solde < -200) {
            throw new Exception("Le solde ne peut pas être inférieur à -200, vous avez un découvert de 200 euros maximum.");
        } else {
            $this->solde = $solde;
        }
    }

    public function afficherSolde(): string
    {
        return "Le solde du compte de " . $this->getTitulaire() . " est de " . $this->getSolde() . " euros.<hr>";
    }

    public function retirer(int $withdrawal): void
    {

        $soldeActuel = $this->getSolde();

        if ($withdrawal <= 0) {
            throw new Exception("Le montant du retrait doit être positif.");
        }

        if ($soldeActuel - $withdrawal < -200) {
            throw new Exception("Le montant que vous souhaitez retirer est trop élevé ! Le solde ne peut pas être inférieur à -200, vous avez un découvert de 200 euros maximum.");
        } else {
            $this->setSolde($soldeActuel - $withdrawal);
        }
    }

    public function deposer(int $deposit): void
    {
        if ($deposit <= 0) {
            throw new Exception("Le montant du dépôt doit être positif.");
        } else {
            $this->setSolde($this->getSolde() + $deposit);
        }
    }
}

$pierraAccount = new CompteBancaire("Pierra", "100");

var_dump($pierraAccount);

echo $pierraAccount->afficherSolde();
$pierraAccount->deposer(1500);
echo $pierraAccount->afficherSolde();
$pierraAccount->retirer(600);
echo $pierraAccount->afficherSolde();
// $pierraAccount->retirer(2000);
echo $pierraAccount->afficherSolde();
