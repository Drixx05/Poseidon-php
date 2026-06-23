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
        if (strlen($pseudo) < 3 || strlen($pseudo) > 20) {
            trigger_error("Le pseudo doit être entre 3 et 20 caractères.", E_USER_NOTICE);
        }
        $this->pseudo = $pseudo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email n'est pas valide.", E_USER_NOTICE);
        }
        $this->email = $email;
    }
}
