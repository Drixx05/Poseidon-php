<?php namespace Model;

use Core\Database;
use Core\Config;
use \PDO;

class Utilisateur {

    public static function inscription(string $pseudo, string $email, string $pswd)
    {
        $db = Database::getConnexion();
        $dbtable = Config::getSetting('db_table');

        $stmt = $db->prepare("INSERT INTO " . $dbtable . " (pseudo, email, password) VALUES (:pseudo, :email, :password)");
        
        return $stmt->execute([
            ':pseudo'   => $pseudo,
            ':email'    => $email,
            ':password' => $pswd 
        ]);
    }

    public static function findPseudo(string $pseudo)
    {
        $db = Database::getConnexion();
        $dbtable = Config::getSetting('db_table');

        $stmt = $db->prepare("SELECT * FROM " . $dbtable . " WHERE pseudo = :pseudo");
        $stmt->execute([':pseudo' => $pseudo]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>