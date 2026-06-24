<?php

// #[\AllowDynamicProperties]

/* 

    Les Méthodes Magiques en PHP 
    Les méthodes magiques sont des fonctions spéciales en PHP que l'on écrit toujours commençant par "__"
    Elles permettent d'intercepter certaines opérations et se lancent sur des scénarios bien précis.
    Dès lors que le scénario survient, le code défini dans la méthode s'exécute ! Libre à nous d'exécuter le code de notre choix 

1. __construct() : Le constructeur
Le constructeur est une méthode appelée automatiquement lors de la création d'une nouvelle instance d'une classe. Elle est utilisée pour initialiser les propriétés d'un objet.

2. __destruct() : Le destructeur
Le destructeur est appelé automatiquement lorsque l'objet est détruit ou lorsque le script se termine. Il peut être utilisé pour effectuer des actions de nettoyage, comme la fermeture d'une connexion à une base de données.

3. __get() et __set() : Accéder et modifier des propriétés non définies
Ces méthodes permettent de gérer dynamiquement l'accès aux propriétés d'une classe qui ne sont pas directement définies.
    __get($nom) : Est invoqué lorsqu'on tente d'accéder à une propriété qui n'existe pas.
    __set($nom, $valeur) : Est appelé lorsqu'on essaie de définir une propriété qui n'existe pas.

4. __call() et __callStatic() : Appel de méthodes non définies
Ces méthodes magiques sont déclenchées lorsque l'on appelle une méthode inexistante dans une classe.
    __call($nom, $arguments) : Pour les méthodes d'instance.
    __callStatic($nom, $arguments) : Pour les méthodes statiques.

5. __toString() : Conversion d'un objet en chaîne de caractères
Cette méthode est appelée lorsqu'un objet est utilisé comme une chaîne de caractères (par exemple, avec echo ou print).

6. __invoke() : Appeler un objet comme une fonction
La méthode __invoke() est appelée lorsque l'on traite un objet comme une fonction. Cela peut être utile pour définir un comportement spécifique lorsqu'un objet est "appelé".

*/

class Societe
{
    public string $adresse;
    public string $ville;
    public string $cp;

    public function __construct()
    {
        echo "<b>Ici c'est le construct ! Instanciation !</b><br>";
    } // Déjà vu chapitre 2, le __construct se lance automatiquement lors d'une instanciation
    public function __destruct()
    {
        echo "<b>Travail terminé !</b><br>";
    } // Le destruct est appelé automatiquement quand l'objet est détruit (fin du script)
    public function __set($nom, $valeur) // Se déclenche uniquement en cas de tentative d'affectation sur une prop non existante
    {
        echo "La props : $nom n'existe PAS ! Donc la valeur : $valeur n'a pas été affectée ! <hr>";
    }
    public function __get($nom)
    {
        echo "La prop $nom n'existe pas, vous ne pouvez donc pas la get !<hr>";
    }
    public function __call($nom, $params)
    {
        echo "Tentative d'exécution de la méthode $nom mais elle n'existe PAS ! Voici les params envoyés : <br> " . implode(" - ", $params) . "<br>";
    }
}

$soc = new Societe;


echo "<h3>Milieu de page</h3>";


$soc->ville = "Tokyo";
$soc->cp = "173000";


$soc->nom = "Toyota";
var_dump($soc);

echo $soc->nom;

$soc->methode("Pierra", 1200000);
