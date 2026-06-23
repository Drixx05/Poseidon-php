<?php

/************************************
   
    EXERCICE :
        Création d'une classe Membre avec cette modélisation 

    ----------------------
    |   Membre           |
    ----------------------
    |  - pseudo :string  |
    |  - email :string   |
    ----------------------
    | + __construct()    |
    | + getPseudo()      |
    | + setPseudo()      |
    | + getEmail()       |
    | + setEmail()       |
    ----------------------

            // S'assurer du bon fonctionnement de la classe à l'instanciation, à l'appel de ses props/méthodes
            // Appliquer des contrôles sur les setters et gérer les cas d'erreurs d'une façon ou d'une autre 
                // Longueur pseudo pas trop long ni trop court 
                // Email d'un vrai format email 
                
 ************************** */

class Membre
{
    private string $pseudo;
    private string $email;

    public function __construct(string $pseudo, string $email)
    {
        $this->setPseudo($pseudo);
        $this->setEmail($email);
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        if (iconv_strlen($pseudo) < 3 || iconv_strlen($pseudo) > 16) {
            throw new Exception("Le pseudo doit avoir entre 3 et 16 caractères");
            // trigger_error("Le pseudo doit avoir entre 3 et 16 caractères");
        } else {
            $this->pseudo = $pseudo;
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email n'est pas valide");
            // trigger_error("L'email n'est pas valide");
        } else {
            $this->email = $email;
        }
    }
}


$membre1 = new Membre("Pierro", "lolo@mail.com");
var_dump($membre1);

echo "Nom du Membre 1 : " . $membre1->getPseudo() . " et puis son email : " . $membre1->getEmail() . "<hr>";

// Pour la gestion des exceptions on utilisera des try/catch (à savoir dans le chapitre Exception)
// try {
    $membre1->setPseudo("Pierra");
    $membre1->setEmail("Pierra@mail.com");
// } catch (Exception $e) {
//     echo "Coucou, j'ai pas de fatal error :) <br>";
// }


echo "Nouvelles informations du Membre 1 : " . $membre1->getPseudo() . " et puis son email : " . $membre1->getEmail() . "<hr>";
