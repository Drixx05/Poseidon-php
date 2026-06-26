<?php

declare(strict_types=1);

namespace App\Auth\Domain\ValueObjects;

final class Email
{
    public readonly string $value;

    public function __construct(string $value)
    {
        $value = strtolower(trim($value));

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email invalide : « {$value} »");
        }

        $this->value = $value;
    }
}
