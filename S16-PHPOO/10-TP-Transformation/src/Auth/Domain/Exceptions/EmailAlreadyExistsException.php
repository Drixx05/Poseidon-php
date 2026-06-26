<?php
declare(strict_types=1);

namespace App\Auth\Domain\Exceptions;

use App\Auth\Domain\ValueObjects\Email;

final class EmailAlreadyExistsException extends \RuntimeException
{
    public static function withEmail(Email $email): self
    {
        return new self("Un utilisateur avec l'email « {$email->value} » existe déjà.");
    }
}