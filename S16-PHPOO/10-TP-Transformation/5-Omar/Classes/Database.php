<?php

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=" . Config::DB_HOST .
            ";dbname=" . Config::DB_NAME .
            ";charset=utf8",
            "root",
            "root"
        );

        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}