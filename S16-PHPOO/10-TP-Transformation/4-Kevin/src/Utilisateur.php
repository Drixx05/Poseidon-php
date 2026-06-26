<?php

namespace ProjetKevin;

use PDO;

class Utilisateur
{
    private ?int $id_utilisateur = null;
    private string $pseudo = "";
    private string $email = "";
    private string $password = "";
    private string $role = "user";

    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function save(): bool
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (pseudo, email, password, role) VALUES (:pseudo, :email, :password, :role)");
        $result = $stmt->execute([
            ":pseudo" => $this->pseudo,
            ":email" => $this->email,
            ":password" => $this->password,
            ":role" => $this->role
        ]);

        if ($result) {
            $this->id_utilisateur = (int) $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public static function findByPseudo(string $pseudo): ?self
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");
        $stmt->execute([":pseudo" => $pseudo]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new self();
            $user->id_utilisateur = (int) $data["id_utilisateur"];
            $user->pseudo = $data["pseudo"];
            $user->email = $data["email"];
            $user->password = $data["password"];
            $user->role = $data["role"];
            return $user;
        }

        return null;
    }

    public static function pseudoExists(string $pseudo): bool
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");
        $stmt->execute([":pseudo" => $pseudo]);
        return $stmt->rowCount() > 0;
    }
}
