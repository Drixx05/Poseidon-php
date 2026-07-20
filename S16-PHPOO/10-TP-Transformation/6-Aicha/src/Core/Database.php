<?php namespace Core;

use \PDO;
use \PDOException;

class Database {

    private static $pdo = null;

    public static function getConnexion() {
        if (self::$pdo === null) {
            try {
                $host = Config::getSetting('db_host');
                $dbname = Config::getSetting('db_name');
                $login = "root"; 
                $password = ""; 

                self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
                
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}