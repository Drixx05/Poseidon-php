<?php

declare(strict_types=1);

namespace App\Auth\Domain\Exceptions;

final class InvalidCredentialsException extends \RuntimeException
{
    public static function create(): self
    {
        return new self('Email ou mot de passe invalide.');
    }
}
