<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database;

use App\Shared\Infrastructure\Config;

class PdoConnection
{
    public function __construct(private readonly Config $config) {}

    public function connect(): \PDO
    {
        $dsn = "mysql:host={$this->config->get('host')};dbname={$this->config->get('dbname')};charset={$this->config->get('charset')}";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new \PDO($dsn, $this->config->get('user'), $this->config->get('password'), $options);
    }
}
