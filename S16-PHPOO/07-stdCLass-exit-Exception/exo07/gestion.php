<?php
session_start();


class User
{
    private string $username;
    private string $role;

    public function __construct(string $username, string $role)
    {
        $this->username = $username;
        $this->role = $role;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}


if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin') {
    die("Accès refusé. Vous n'êtes pas administrateur.");
} else {
    echo "Bienvenue sur la page d'administration, " . $_SESSION['user']->getUsername() . " !";
}

?>