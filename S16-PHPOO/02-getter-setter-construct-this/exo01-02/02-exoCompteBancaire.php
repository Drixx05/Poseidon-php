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
            throw new Exception("Le pseudo doit être entre 3 et 20 caractères.");
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

    public function afficherSolde(string $titulaire, float $solde): string
    {
        return "Le solde du compte de $titulaire est de $solde euros.";
    }

    public function retirer(string $withdrawal): void
    {
        if ($withdrawal <= 0) {
            throw new Exception("Le montant du retrait doit être positif.");
        }

        if ($this->solde - $withdrawal < -200) {
            throw new Exception("Le solde ne peut pas être inférieur à -200, vous avez un découvert de 200 euros maximum.");
        } else {
            $this->solde -= $withdrawal;
        }
    }

    public function deposer(string $deposit): void
    {
        if ($deposit <= 0) {
            throw new Exception("Le montant du dépôt doit être positif.");
        } else {
            $this->solde += $deposit;
        }
    }
}
