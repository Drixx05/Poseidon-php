<?php 
/* 

En POO les concepts de getter, setter, constructer et $this sont des mécanismes essentiels qui permettent d'organiser et de structure les classes tout en contrôlant la manipulation des props des objets 

    -- Le Constructeur (__construct)
        Le constructeur est une méthode magique dans une classe qui est automatiquement appelée lors de la création d'un objet à partir de cette classe. Il permet d'initialiser les props de l'objet dès sa création et éventuellement lancer aussi d'autres traitement
        Sa condition de lancement est définie (à l'instanciation), libre à nous de lui dire d'exécuter n'importe quel code 

    -- Le mot clé $this 
        Le mot clé $this fait référence à l'objet courant / l'objet en train d'être utilisé ! Il permet d'accéder aux props et méthodes de cet objet depuis l'intérieur de la classe 

    -- Les Getters 
        Un getter est une méthode toujours public qui permet d'accéder aux props d'une classe tout en gardant les props elles mêmes protected ou private. Cela permet de mieux contrôler l'accès aux données 

    -- Les setters 
        Un setter est une méthode public qui nous permet de modifier la valeur d'une prop private ou protected, comme pour les getters cela permet de valider et controler les changements sur les props 

            Il y aura toujours une paire getter/setter pour chaque props de l'objet ! 
                // On peut profiter d'un setter pour vérifier le formatage de l'info transmise, mais ce n'est pas obligatoire 

                // Par contre il est toujours bon de passer toujours par les setter et getter pourquoi ? Il faut penser à l'avenir de notre app !
                    // Il est toujours bon de normaliser les appels des props de nos objets (c'est à dire toujours avec un getNomDeProp, ou setNomDeProp) pour s'assurer que ce n'et pas différent d'un objet à l'autre 
                    // Idem si aujourd'hui je ne fais pas de vérification dans mon setter, mais que demain je souhaite le faire, pas de soucis, ça ne changera l'appel du setter, ce sera le corps de la method setter de cette prop qui sera modifié

*/

class Utilisateur 
{
    protected string $nom;
    protected string $email;

    // Ici le __construct se lance direct à l'instanciation de l'objet, je lui indique qu'il attends deux param qui sont maintenant obligatoire
    // Je m'en sers pour directement insérer des valeurs dans les props de l'objet Utilisateur 
    public function __construct(string $nom, string $email)
    {
        // echo "<h2>COUCOU ! Je suis le construct ! :) </h2>"; // Petit message pour vérifier le passage dans le construct 
        $this->setNom($nom); // Autant appeller déjà ici nos setters ! Pour les vérifications 
        $this->setEmail($email);
    }

    public function saluer(): string
    {
        // Ici $this me permet de faire référence à la prop $nom de l'objet sur lequel on est en train d'utiliser la méthode saluer()
        return "Bonjour, je m'appelle $this->nom";
    }

    public function getNom() 
    { // Un getter me sert simplement à récupérer la valeur d'une prop, ici le nom 
        return $this->nom;
    }

    public function setNom(string $newNom) 
    { // Un setter me sert à faire une affectation dans une prop, et pourquoi pas appliquer une vérification (ici la longueur du nom)
        if(iconv_strlen($newNom) >= 1) {
             $this->nom = $newNom;
        } else {
            trigger_error("Le nom ne peut pas être null", E_USER_NOTICE);
        }
    }

    public function getEmail() 
    {
        return $this->email;
    }

    public function setEmail(string $newEmail)
    {
        $this->email = $newEmail;
    }
}

$utilisateur1 = new Utilisateur("Bob", "bob@mail.com");

// $utilisateur1->nom = "Bob";
// $utilisateur1->email = "bob@mail.com";

var_dump($utilisateur1);

echo $utilisateur1->saluer();

// echo $utilisateur1->nom;

// J'aimerai modifier les infos de l'utilisateur 
// Malheureusement si mes props sont protected ou private je peux pas...
// $utilisateur1->nom = "Boby";
// echo $utilisateur1->nom;
// Je vais donc avoir besoin de methodes pour pouvoir les modifiers au travers du scope local de la classe, c'est les setters et getters 

$utilisateur1->setNom("Boby");
echo $utilisateur1->getNom();

$utilisateur1->setNom("bobobo");
$utilisateur1->setEmail("boby@mail.com");


?>