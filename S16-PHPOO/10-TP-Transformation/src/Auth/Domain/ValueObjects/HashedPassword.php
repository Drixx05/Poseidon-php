<?php

declare(strict_types=1);

namespace App\Auth\Domain\ValueObjects;

final class HashedPassword
{
    private function __construct(public readonly string $hash) {}

    // Porte n°1 — inscription : on reçoit du clair, on hache.
    public static function fromPlainText(string $plainText): self
    {
        if (strlen($plainText) < 8) {
            throw new \InvalidArgumentException('Le mot de passe doit faire au moins 8 caractères.');
        }

        return new self(password_hash($plainText, PASSWORD_DEFAULT));
    }

    // Porte n°2 — connexion : la valeur vient de la base, déjà hachée.
    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    // Connexion : compare le clair saisi au hash stocké.
    public function verify(string $plainText): bool
    {
        return password_verify($plainText, $this->hash);
    }
}