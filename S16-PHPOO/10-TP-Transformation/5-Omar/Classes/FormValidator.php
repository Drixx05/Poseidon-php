<?php

class FormValidator
{
    private array $errors = [];

    public function validateRegister(
        string $pseudo,
        string $email,
        string $password,
        string $confirmPassword
    ): array {

        if (empty($pseudo)) {
            $this->errors[] = "Pseudo obligatoire";
        }

        if (iconv_strlen($pseudo) < 3) {
            $this->errors[] = "Pseudo minimum 3 caractères";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Email invalide";
        }

        if (iconv_strlen($password) < 6) {
            $this->errors[] = "Mot de passe minimum 6 caractères";
        }

        if ($password !== $confirmPassword) {
            $this->errors[] = "Les mots de passe ne correspondent pas";
        }

        return $this->errors;
    }
}