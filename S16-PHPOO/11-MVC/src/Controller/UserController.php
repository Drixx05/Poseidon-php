<?php

namespace ProjetMVC\Controller;

use ProjetMVC\Model\UserRepository;

class UserController
{
    // Ici une prop qui va contenir un objet de type Model, c'est notre élément qui nous permet de piocher en bdd
    protected UserRepository $model;

    public function __construct()
    {
        // echo "<h3>Initialisation du construct : Instanciation de UserController</h3>";
        $this->model = new UserRepository; // On instancie direct notre model
    }

    // Ici on mets en place la méthode render, c'est une méthode qui va me permettre de gérer l'affichage de mes vues
    // On va utiliser ici l'output buffer, c'est une sorte de mémoire cache, qui permet de mettre le chargement d'une page en staging, le temps de sa construction, pour qu'elle soit flush à l'utilisateur une fois qu'elle est construire ! 
    public function render($layout, $vue, $parameters = array())
    {
        extract($parameters); // extract : c'est une fonction prédéfinie qui permet de transformer les clés d'un array en variable, et ces variables auront le contenu de la clé en question du array 

        ob_start(); // On démarre l'output buffer, c'est la mise en tampon, on garde les données en mémoire à partir d'ici, les instructions de ne déclenche plus directement pour l'utilisateur 

        // Ici on aimerait pouvoir faire  c'est :
        // $content = require("view/$vue"); // Mais cela ne marchera pas ! grâce à l'output buffer on va pouvoir lancer une instruction require, sans qu'elle soit afficher à l'utilisateur 

        require_once "src/View/$vue"; // Cette inclusion est stockée dans le buffer ! 

        $content = ob_get_clean(); // Le buffer est vidé et le $content est rempli avec le morceau de page ! (pour nous avec selectAll, on a rempli ça avec la vue ListUser.php)

        ob_start();
        require_once "src/View/$layout"; // Envoi du layout de base de notre page, comme $content existe depuis la ligne au dessus, il sera convenablement inséré dans notre layout

        // A partir de là, la page est entièrement construire et je peux flush l'affichage ! 

        return ob_end_flush(); // Libération de l'affichage pour l'utilisateur


    }

    // Ici cette méthode handleRequest, me sert à comprendre le scénario d'arrivée de l'utilisateur
    // Grâce à elle je vais réussir à dissocier les scénar et à piocher la data nécessaire et d'appeller la vue nécessaire 
    public function handleRequest()
    {
        if (isset($_GET["op"])) { // Dans ce op seront transmis les demande de l'utilisateur sur la manipulation des Users, par exemple add, select etc 
            $op = $_GET["op"];
        } else {
            $op = null;
        }
        
        if (isset($_GET["id"])){ // Dans certains scénarios on aura besoin d'un id, pour le select, update, delete 
            $id = $_GET["id"];
        } else {
            $id = null;
        }

        try { // Ici dans ce try je vais vérifier la valeur de op et lancer des méthodes distinctes pour chaque cas 
            // Si l'utilisateur demande à ajouter un user 

            // Chacune des méthodes de ce controller doit être implémentée
            if ($op == "add") {
                $this->add();
            } elseif ($op == "select") { // S'il a demandé à voir un utilisateur 
                $this->select($id);
            } elseif ($op == "delete") { // S'il a demandé à supprimer un user 
                $this->delete($id);
            } elseif ($op == "update") { // S'il a demandé à modifier un user 
                $this->update($id);
            } else {
                $this->selectAll();
            }
        } catch (\Exception $e) {
        }
    }

    // Ci-dessous, la logique métier en fonction de chaque scénar 

    // Le controller ici comprends le scénar de la requête utilisateur demandée, et comprends la data à utiliser/manipuler
    // Chacune de ces méthodes défini par exemple un $title pour avoir des $title dynamique sur toutes nos pages
    // Chacune de ces méthodes lance aussi la méthode render qui indique quel est le layout à utiliser, quelle est la vue propre à cette page, quels sont les params à transmettre à la vue pour qu'elle puisse convenablement afficher la bonne data
    // La vue est ensuite transmise à l'utilisateur une fois que tout est chargé  
    public function selectAll()
    {
        // Je tombe ici lorsque l'utilisateur n'a pas demandé un scénar spécifique, par defaut on cherche à récupérer et afficher TOUS les users 
        // Première chose à faire ? 
        // Récupérer les users de la bdd 
        // Qui s'occupe de récupérer les users dans la BDD ? Le model !
        // echo "<h3>Je suis dans la méthode selectAll()</h3>";

        $title = "Liste des Employes";
        $users = $this->model->modelSelectAll(); // Chaque méthode du controller, appelle le model pour intéragir avec la data 

        // require("src/View/template.php");

        $this->render("layout.php", "ListUser.php", [
            "title" => $title,
            "data" => $users
        ]);
    }

    public function select($id)
    { // Ici la méthode pour select un seul employé
    // On change le title, on appelle une méthode différente de notre model pour selectionner un seul employe
        $title = "Information d'un utilisateur";
        $user = $this->model->modelSelectOne($id);
    // On appelle la vue spécifique à ce scénar
         $this->render("layout.php", "OneUser.php", [
            "title" => $title,
            "data" => $user
        ]);
    }

    public function add() 
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {
        
    }
}
