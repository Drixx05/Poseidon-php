<?php 

/* 

La programmation orienté objet (POO) en PHP repose sur quelques concepts clés comme les classes, les objets qui sont eux même des instances.
Elle inclut également des notions de visibilité qui contrôlent l'accès aux propriétés et aux méthodes en fonction du scope 




*/


// 1. Déclaration d'une classe 
// Une classe en PHP est un modèle qui définit des props (variables) et des méthodes (fonctions) qui seront partagées par les objets créés à partir de cette classe


class Voiture 
{

    // Propriétés 
    public ?string $marque = null;  // Il est toujours bon de définir les types de nos propriétés et si jamais on autorise la valeur null, on doit rajouter un "?" devant le type 
    public string $couleur; // Je peux définir déjà ici des valeurs par défauts pour nos props, sinon elles seront vide "non initialisée"

    protected int $km; 
    private string $moteur;


    // Méthodes 
    public function demarrer() 
    {
        return "La voiture démarre !<br>";
    }

    protected function ajouterKm() // Les méthods protected et private ne sont pas visible au var_dump de get_class_methods (ben oui, on ne peut pas les utiliser nous même de toute façon...)
    {
        return "Ajout de km";
    }

}

// echo demarrer(); // Je ne peux pas appeler cette méthode de manière globale, elle appartient aux objets Voiture ! Je dois donc d'abord créer un objet de la classe Voiture 

// 2. Instanciation d'une classe 
    // Pour utiliser une classe on doit créer un objet à partir de celle-ci. C'est ce qu'on appelle une instanciation
    // On va faire un "new" Voiture 

    // Instanciation de la classe Voiture 
    $voiture1 = new Voiture();

    // Je remarque dans le var_dump que j'ai bien un objet Voiture 
    // Le var_dump m'indique uniquement les propriétés
    var_dump($voiture1);

    // Si je veux voir les méthodes, je dois utiliser get_class_methods 
    var_dump(get_class_methods($voiture1));

    // Assignation de valeurs aux propriétés 
    $voiture1->marque = "Toyota"; // On utilise ici la flèche pour pointer sur un élément de mon objet 
    $voiture1->couleur = "Blanche";

    // On vérifie les valeurs
    var_dump($voiture1);

    // Appel de la méthode demarrer() 
    echo $voiture1->demarrer();

    // On peut créer d'autres objets, qui seront tous indépendant les uns des autres 
    $voiture2 = new Voiture();
    $voiture2->marque = "Peugeot";
    $voiture2->couleur = "Bleue";

    $voiture3 = new Voiture();
    $voiture3->marque = "BMW";
    $voiture3->couleur = "Rouge";

    var_dump($voiture1);
    var_dump($voiture2);
    var_dump($voiture3);

    // Jusque là, nous avons instancié l'objet venant de la classe Voiture et nous avons accédé aux props et méthodes depuis le scope global
    // SI je peux faire ça, c'est parceque la visibilité de mes éléments est notée en "public"
    // Effectivement tant qu'un élément est public il est appelable depuis le scope global
    // props = modifiable et appelable
    // methode = callable 

    // Nous allons rajouter d'autres éléments avec d'autres niveaux de visibilité : 

    // 3. Visibilité : public, protected, private 
        // La visibilité en POO définit le niveau d'accès aux propriétés et méthodes d'une classe
            // Public : Les props/methods public sont accessibles depuis n'importe où, y compris le scope global (extérieur de la classe en gros)
            // Protected : Les props/methods protected sont accessibles uniquement dans le scope local de la classe et de ses classes dérivées (héritage), les protected tout comme les public se transmettent lors d'un héritage
            // Private : Les props/methods protected sont accessibles uniquement dans le scope local de la classe MAIS ne sont pas transmis aux sous-classe, les private ne transitent pas à l'héritage

    // $voiture1->km = 12000; // Fatal error on ne peut pas accéder à une props/method protected depuis le scope global
    // $voiture1->moteur = "diesel"; // Fatal error on ne peut pas accéder à une props/method private depuis le scope global
    // MAIS, on pourra y accéder depuis le scope local de la classe
        // En gros, on y a pas accès depuis l'extérieur, donc toute modification doit se faire depuis l'intérieur au travers d'appel de méthodes
            // On aura généralement des methods public qui nous permettront d'intéragir avec des props protected/private, c'est ce qu'on appelle les : setters & getters 




?>