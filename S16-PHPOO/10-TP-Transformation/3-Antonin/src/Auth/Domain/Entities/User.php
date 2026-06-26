<?php

declare(strict_types=1);

namespace App\Auth\Domain\Entities;

use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\HashedPassword;

final class User
{
    public readonly string $id;
    public readonly string $name;
    public readonly Email $email;
    public readonly HashedPassword $password;

    public function __construct(string $id, string $name, Email $email, HashedPassword $password)
    {
        $id = trim($id);
        $name = trim($name);

        if ($id === '') {
            throw new \InvalidArgumentException("L'identifiant de l'utilisateur ne peut pas être vide.");
        }
        if ($name === '') {
            throw new \InvalidArgumentException("Le nom de l'utilisateur ne peut pas être vide.");
        }
        if (strlen($name) > 255 || strlen($name) < 3) {
            throw new \InvalidArgumentException("Le nom de l'utilisateur ne peut pas dépasser 255 caractères et doit en contenir au moins 3 caractères.");
        }

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
