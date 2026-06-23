<?php

/*********************
 
    EXERCICE :

        Création de la classe Vehicule et de la classe Pompe en suivant ces modélisations

    ----------------------
    |   Vehicule         |
    ----------------------
    |-litresReservoir:int|
    ----------------------
    |+setlitresReservoir()|
    |+getlitresReservoir()|
    ----------------------

    ----------------------
    |   Pompe            |
    ----------------------
    | -litresStock:int   |
    ----------------------
    | +setlitresStock()  |
    | +getlitresStock()  |
    | +donnerEssence()   |
    ----------------------

        Spécifications : 
            - Le réservoir d'un véhicule contient maximum 50 litres (les voitures ont toutes le meme reservoir)
            - La méthode donnerEssence() distribue automatiquement si elle le peut ! le plein (50litres) à la voiture  (c'est à dire on ne laisse pas la possibilité au user de choisir le nombre de litres qu'il veut)
            - Gérez les exceptions qui peuvent être rencontrées à l'appel de la méthode donnerEssence()


 */

class Vehicule
{
    private int $litresReservoir;

    public function setLitresReservoir(int $litres): void
    {
        if ($litres < 0 || $litres > 50) {
            trigger_error("Le réservoir doit contenir entre 0 et 50 litres.", E_USER_NOTICE);
        }
        $this->litresReservoir = $litres;
    }

    public function getLitresReservoir(): int
    {
        return $this->litresReservoir;
    }
}

class Pompe
{
    private int $litresStock;

    public function setLitresStock(int $litres): void
    {
        if ($litres < 0) {
            trigger_error("Le stock de la pompe ne peut pas être négatif.", E_USER_NOTICE);
        }
        $this->litresStock = $litres;
    }

    public function getLitresStock(): int
    {
        return $this->litresStock;
    }

    public function donnerEssence(Vehicule $vehicule): void
    {
        $litresNecessaires = 50 - $vehicule->getLitresReservoir();
        if ($litresNecessaires <= 0) {
            trigger_error("Le véhicule a déjà un réservoir plein.", E_USER_NOTICE);
        }
        if ($this->litresStock < $litresNecessaires) {
            trigger_error("La pompe n'a pas assez de stock pour remplir le véhicule.", E_USER_NOTICE);
        }
        $vehicule->setLitresReservoir(50);
        $this->litresStock -= $litresNecessaires;
    }
}

?>