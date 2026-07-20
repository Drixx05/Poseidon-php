<?php

namespace ProjetKevin;

class FormValidator
{
    private array $errors = [];

    public function validatePseudo(string $pseudo): void
    {
        if (empty($pseudo)) {
            $this->errors[] = "Le pseudo est obligatoire.";
        } elseif (iconv_strlen($pseudo) < 3) {
            $this->errors[] = "Le pseudo est trop court, minimum 3 caractères.";
        }
    }

    public function validateEmail(string $email): void
    {
        if (empty($email)) {
            $this->errors[] = "L'email est obligatoire.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Le format de l'email n'est pas valide.";
        }
    }

    public function validatePassword(string $password, string $confirm): void
    {
        if (empty($password)) {
            $this->errors[] = "Le mot de passe est obligatoire.";
        } elseif (iconv_strlen($password) < 6) {
            $this->errors[] = "Le password est trop court, 6 caractères mini.";
        }

        if ($password !== $confirm) {
            $this->errors[] = "Les mots de passe ne correspondent pas.";
        }
    }

    public function checkPseudoUnique(string $pseudo): void
    {
        if (Utilisateur::pseudoExists($pseudo)) {
            $this->errors[] = "Le pseudo est déjà pris.";
        }
    }

    public function addError(string $message): void
    {
        $this->errors[] = $message;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
