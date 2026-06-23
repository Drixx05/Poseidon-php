<?php 

/* 

Exercice 2 : Gestion de Panier avec static et const

Objectif : Créer un système simple de gestion de panier avec une classe Panier qui utilise des propriétés et méthodes statiques pour gérer le nombre total de produits et des constantes pour définir des paramètres spécifiques au panier.

Énoncé :

    Créez une classe Panier qui contiendra :
        Une constante MAX_ITEMS qui définira le nombre maximum d'articles dans le panier.
        Une propriété statique $totalItems qui contiendra le nombre total d'articles.
        Une méthode statique ajouterProduit($quantite) qui permet d'ajouter un produit au panier (en respectant la limite définie par MAX_ITEMS).
        Une méthode statique afficherTotal() qui affiche le nombre total d'articles dans le panier.

        */

class Panier {
    
    const MAX_ITEMS = 15;
    private static $totalItems = 0;

    public static function ajouterProduit(int $quantite) {
        if (self::$totalItems + $quantite > self::MAX_ITEMS) throw new Exception("Impossible d'ajouter  d'autres produits. Le panier ne peut contenir que " . self::MAX_ITEMS . " articles au maximum. Achetez d'abord !");
        self::$totalItems += $quantite;
    }

    public static function afficherTotal() {
        echo "Articles dans le panier: " . self::$totalItems . "\n";
    }
}