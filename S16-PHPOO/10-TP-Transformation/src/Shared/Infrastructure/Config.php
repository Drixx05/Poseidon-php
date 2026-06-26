<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure;

class Config
{
    private ?array $config = null;

    public function get(string $key): mixed
    {
        if ($this->config === null) {
            $this->config = require __DIR__ . '/../../../config/database.php';
        }

        return $this->config[$key] ?? throw new \InvalidArgumentException("Key not found: $key");
    }
}
