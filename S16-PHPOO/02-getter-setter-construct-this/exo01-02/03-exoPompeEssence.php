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