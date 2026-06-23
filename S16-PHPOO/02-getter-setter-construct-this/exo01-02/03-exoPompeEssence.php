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

    public function getLitresReservoir()
    {
        return $this->litresReservoir;
    }

    public function setLitresReservoir(int $newReservoir): void
    {
        if (is_numeric($newReservoir) && $newReservoir >= 0 && $newReservoir <= 50) {
            $this->litresReservoir = $newReservoir;
        }
    }
}

class Pompe
{
    private int $litresStock;

    public function getLitresStock()
    {
        return $this->litresStock;
    }

    public function setLitresStock(int $newStock): void
    {
        if (is_numeric($newStock) && $newStock >= 0) {
            $this->litresStock = $newStock;
        }
    }

    public function donnerEssence(Vehicule $v)
    {
        // echo "<h3>On est dans la méthode donner Essence</h3>";
        // var_dump($v);
        // var_dump(get_class_methods($v));

        $litresReservoir = $v->getLitresReservoir(); // Ce qu'il reste dans le vhc 
        $litresStock = $this->getLitresStock(); // Ce qu'il reste dans la pompe 
        $litresManquant = 50 - $litresReservoir; // Les litres manquant dans la voiture

        // Plusieurs scénario pour donnerEssence()
            // 1 - La pompe est vide ! On ne peut rien faire, la pompe reste à 0, les litres du vhc restes inchangés 
            // 2 - Le véhicule a déjà le plein ! Rien à faire :)
            // 3 - La pompe a assez pour faire le plein ! Le vhc passe à 50 et on soustrait à la pompe les litres manquant du vhc 
            // 4 - La pompe a des litres, mais pas assez pour faire le plein... On va donner au vhc ce qu'on peut. La pompe passe à 0, et le vhc récupère quelques litres 

            if($litresStock == 0) {  // 1 - Pompe vide
                echo "<h3>Désolé la pompe est vide</h3><hr>";
            } elseif ($litresManquant == 0) { // 2 - La voiture a déjà le plein
                echo "<h3>Vous avez déjà le plein !</h3><hr>";
            } elseif ($litresStock >= $litresManquant) { // 3 - On a assez pour faire le plein ! 
                $this->setLitresStock($litresStock - $litresManquant); // On soustrait les litres qu'on rajoute dans la voiture, à la pompe
                $v->setLitresReservoir(50); // La voiture a le plein ! 
                echo "<h3>On vous a mis le plein !</h3><hr>";
            } else { // 4 - On a des litres mais pas assez pour faire le plein, on donne tout ! 
                $v->setLitresReservoir($litresStock + $litresReservoir); // On rajoute à la voiture, les litres présents dans la pompe
                $this->setLitresStock(0); // La pompe elle, passe à 0 
                echo "<h3>Pas assez pour faire le plein, on a mis tout ce qu'on avait !</h3><hr>";
            }

    }
}

$vehicule1 = new Vehicule;
$pompe1 = new Pompe;
$vehicule1->setLitresReservoir(40);
$pompe1->setLitresStock(40);

$vehicule2 = new Vehicule;
$vehicule3 = new Vehicule;
$vehicule2->setLitresReservoir(10);
$vehicule3->setLitresReservoir(20);



var_dump($vehicule1);
var_dump($pompe1);

echo "Vehicule1 nombre de litres : " . $vehicule1->getLitresReservoir() . "<br>";
echo "Pompe1 nombre de litres : " . $pompe1->getLitresStock() . "<br>";


$pompe1->donnerEssence($vehicule1); // On a assez pour faire le plein ! 
var_dump($vehicule1);
var_dump($pompe1);

$pompe1->donnerEssence($vehicule1); // On a déjà le plein ! 
var_dump($vehicule1);
var_dump($pompe1);

$pompe1->donnerEssence($vehicule2); // Pas assez pour le plein ! On donne ce qu'il reste
var_dump($vehicule2);
var_dump($pompe1);

$pompe1->donnerEssence($vehicule3); // La pompe est vide :( 
var_dump($vehicule3);
var_dump($pompe1);



