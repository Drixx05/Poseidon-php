<?php 
// namespace App;
/*

    Les Namespaces en PHP : 

Les namespaces en PHP c'est un moyen d'organiser et de structure les classes, interfaces, fonctions et autres de manière logique pour éviter essentiellement les conflits de nom.
Ils sont particulièrement utile dans les projets complexes ou lorsque l'on appelle des bibliothèques externes.

En gros, les namespaces vont éviter les collisions de noms en séparant avec des espaces de noms/namespace  (comme des dossiers virtuels) 


*/


// Classe que j'ai faites moi même
// namespace MyLibrary; // En rajoutant un namespace cette classe n'est plus simplement la classe utilisateur mais elle est la classe MyLibrary\Utilisateur
// class Utilisateur 
// {
//     public function getNom() 
//     {
//         return "Bob";
//     }
// }

// J'importe une librairie sur mon projet
// Elle aussi contient une classe Utilisateur :(   
// namespace LibraryA; // Ici également ce n'est plus Utilisateur mais LibraryA\Utilisateur 
// class Utilisateur 
// {
//     public function getName() 
//     {
//         return "Jean";
//     }
// }

// Bien que l'on puisse définir plusieurs namespace dans un fichier, ce n'est pas une bonne pratique !
// On se rappelle de l'organisation de nos fichiers en PHP OO, une classe = un fichier   donc on aura un seul namespace par fichier
// Evidemment, des classes peuvent partager le même namespace 
// Egalement, on peut avoir des namespaces composés par exemple App\MyClasses\Controller

// En PHP OO pour utiliser une classe venant d'un autre fichier, on utilise les instructions include et/ou require 

use LibraryA\Utilisateur as User;
use MyLibrary\Utilisateur;

require("LibraryUtilisateur.php");
require("MyUtilisateur.php");

// A partir de maintenant grâce aux namespaces je n'ai plus de conflit dans mes classes Utilisateur qui sont en fait deux éléments différents 

// Comment les instancier ? 

// Plusieurs façons de faire : 
// 1 - Avec le FQN 
// Fully Qualified Name, c'est le nom entier de l'élément incluant son namespace 
// Il nous suffit de faire un new puis tous les namespaces séparés par des antislash puis le nom de la classe 

$myUser = new MyLibrary\Utilisateur;
$libraryUser = new LibraryA\Utilisateur;

var_dump($myUser);
var_dump($libraryUser);

// 2 - Avec l'importation au travers de use 
// Dans mon IDE, lorsque je saisi uniquement un nom de classe, il me proposera toutes les classes qu'il connait avec ce nom, également celles qui viennent de namespace spécifique
// Si je choisis à l'autocompletion par exemple le Utilisateur venant de MyLibrary, automatiquement l'IDE va rajouter une instruction "use" en haut de mon fichier et il indiquera :
// use MyLibrary\Utilisateur;
// Ce qui se traduit par : "Lorsqu'on parle de Utilisateur tout court, on parle de MyLibrary\Utilisateur"
$user = new Utilisateur;
var_dump($user);

// Egalement, si on a deux classes du même nom, le use s'adapte en donnant un alias à la classe :) 
// Par exemple ici je peux définir que Utilisateur de la LibraryA s'appelle maintenant User tout court 
$user2 = new User;

// Grâce à mon IDE, le système d'utilisation de mes classes à namespace devient beaucoup plus simple et j'ai moins besoin de réfléchir contrairement à l'utilisation des FQN ! 

// Il existe une constante magique qui nous permet de savoir dans quel namespace on se trouve __NAMESPACE__ 
// Par défaut cela ne renvoie rien quand on est dans le namespace global
echo __NAMESPACE__;

// Si je me trouve dans un Namespace, je suis à un niveau différent du scope global normal de PHP ! 
// C'est à dire que toutes les classes natives de PHP ne sont pas présente dans ce namespace
// Pour retrouver le scope global de PHP et ses classes, il faudra "remonter d'un niveau" en indiquant un antislash devant l'appel de nos classe 

// Par exemple PDO, je n'y ai plus accès... je dois donc faire new \PDO();
// $pdo = new \PDO("");

// Attention toutefois, sur une architecture plus avancée, on passe toujours par l'index, qui lui n'a pas de namespace, ce qui enlève completement cette problematique

// Il est reccomandé de faire correspondre la structure des namespaces avec la structure de nos dossiers pour mieux organiser le projet 

// Exemple : 
    /*
        - MonProjet/ 
            - Modele/ 
                - Utilisateur.php 
            - Controller/ 
                - UtilisateurController.php

        Ainsi le fichier Utilisateur.php pourrait avoir le namespace MonProjet\Modele et UtilisateurController.php le namespace MonProjet\Controller   
        En fonction des normes, on pourra dire que le namespace du dossier racine, est toujours le namespace "App"

        Les namespaces sont généralement utilisés conjointement avec l'autoload (chapitre suivant) pour éviter de devoir inclure manuellement chaque fichier
        Chaque classe que j'utilise chacune dans son fichier séparé devrait normalement être include/require, l'autoload va le faire pour nous et il fonctionnera avec les namespaces et du fait de la syntaxe avec les \ il va rentrer directement dans des dossiers

        --- Pour ça on utilise la convention de nommage PSR-4 

        - Le PSR-4 c'est une convention de nommage et d'organisation des fichiers dans un projet qui vise à standardiser l'autoloading des classes. Pour ça la structure est très claire pour mapper les namespaces aux dossiers et les classes aux fichiers 

            - Chaque classe doit avoir un namespace qui correspond à sa structure de repertoire sur le serveur
            - Le nom de la classe doit correspondre au nom du fichier dans lequel la classe est définie 
            - AUtoloading permettra de rentrer dans chaque dossier en rapport au nom des namespaces 

            Point important de la PSR-4, c'est que l'on nommera un namespace racine qui sera mappé vers un dossier spécifique et ensuite on utilisera les noms des namespaces pour nom de dossier 

                Par exemple : 
                    Namespace : ProjetPierra\Controller 
                    Class : UserController

                    Le namespace ProjetPierra sera mappé vers un dossier nommé "src" 
                        - src/ 
                            - Controller/ 
                                - UserController.php 

            --- Bonnes pratiques : 
                - Nommer les namespaces de façon logique : Organisez les classes par fonctionnalité 
                    Par exemple on regroupe les Model dans un namespace et dossier Model, les controleurs dans Controller, nos propres classes custom dans MyClasses 
                - On suit la norme PSR-4 avec le dossier racine puis ensuite des dossiers en rapport à nos namespaces 
                - On évite les noms trop longs ou ambigus 

    */