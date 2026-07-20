<?php

namespace ProjetKevin;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public static function getInstance(): PDO
    {
        if (self::$pdo === null) {
            $host = Config::get("db_host");
            $dbname = Config::get("db_name");
            $login = Config::get("db_user");
            $password = Config::get("db_pass");

            $dsn = "mysql:host=$host;dbname=$dbname";
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            );

            try {
                self::$pdo = new PDO($dsn, $login, $password, $options);
            } catch (PDOException $e) {
                echo "Erreur de BDD";
                exit;
            }
        }
        return self::$pdo;
    }
}
