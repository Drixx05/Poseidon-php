<?php 

/* 

    - 1 : Les constantes 
Les constantes dans une classe sont des éléments "static" c'est à dire qu'ils appartiennent à la classe.
Par défaut leur niveau de visibilité est public mais on peut à présent aussi le mettre en protected ou private si on le souhaite 
On y accède directement via le nom de la classe
On s'en sert pour définir des informations souvent de configuration de notre app ou d'un comportement 
Convention : Toujours en MAJ  
(on les défini avec const, alors qu'on définissait une constante globale avec define())

    - 2 : Les props et méthods static 
Les éléments statics appartiennent à la classe elle même et non aux objets instanciés de cette classe. Cela veut dire que nous pouvons accèder aux éléments en question sans créer d'instance de cette classe ! (Pas besoin de faire un new Panier pour utiliser les éléments ci dessous) 
On utilise le mot clé static devant le nom de la prop et de la methode 

    - 3 : Le mot clé self 
Le mot clé est utilisé pour accéder aux éléments static d'une classe à l'intérieur d'elle même, c'est l'équivalent du $this dans le contexte objet
Attention à la syntaxe self::    (alors que $this->)


// Dans quel cas est ce qu'on utilise le static ?
// On utilise le static pour mieux classer nos éléments, parfois on va vouloir définir des fonctions globales pour faire par exemple des vérifications
    // Autant les classer dans une seule et même classe ?
// Pour d'autres classes que nous utiliserons de manière classique, on aura tendance à définir des constante static pour définir des éléments de configuration de l'élément 


*/


class Panier 
{
    public static $totalPanier = 0; // Ici une prop static, elle apaprtient à la classe ! Pas à l'objet
    public const TVA = 20; // Ici une constante de classe ! C'est aussi du static, ça appartient à la classe ! Pas à l'objet
    public string $nomPanier;

    public static function afficherTotal() // Même système pour les méthodes, ici une méthode static, elle appartient à la classe ! Pas à l'objet
    {
        return "Total du panier : " . self::$totalPanier . "€<hr>";
    }

    public function afficherNomPanier() 
    {
        return "C'est le panier : " . $this->nomPanier;
    }
}

// Jusqu'à présent, on définissait une classe avec des props et methods "classiques" c'est à dire qu'elles existent uniquement au travers de l'objet
// Il faut instancier un objet pour que ces props existent et que les methods sont callable 

// On apprends ici une nouvelle notion le "static"
// Le static indique que les éléments en question (props et/ou methods) appartiennent non pas à l'objet, mais, A LA CLASSE ! 
// Ce qui veut dire, pas besoin qu'un objet existe pour appeller ces éléments là 

// $panier = new Panier();
// $panier->totalPanier = 100;

// echo $panier->afficherTotal();

echo Panier::$totalPanier;
echo Panier::afficherTotal();

echo Panier::TVA;


$panier = new Panier;
$panier->nomPanier = "Courses";
echo $panier->afficherNomPanier();


// Quelques exemples d'utilisation de static, pour classer des fonctions utilitaires dans des classes plutot que les déclarer dans le global
// DateFormatage::datefr($date);
// DateFormatage::dateUs($date);
// CalculTva::calculFr($prix);
// CalculTva::calculUS($prix);

echo "<hr>";

// Quelques tests de la souplesse du PHP 

// echo Panier::$nomPanier; // Marche pas, c'est du object context
// echo Panier::afficherNomPanier(); // Marche pas, c'est du object context 

// echo $panier->totalPanier; // Marche pas, j'appelle une static comme une non static
// Aie aie aie : Tout ce qui est dessous ici fonctionne !!! 
// On est en train d'appeller des éléments static de diverses manières, MAIS pas au travers de la classe, mais au travers de l'objet !
// PHP est souple à ce niveau là, mais c'est une mauvaise pratique de développement !
// Si on parle d'élément static, on garde le contexte de call ces éléments là de manière static aussi, c'est à dire par la classe ! Panier:: 
echo $panier::$totalPanier;
echo $panier::afficherTotal();
echo $panier->afficherTotal();
echo $panier::TVA;




