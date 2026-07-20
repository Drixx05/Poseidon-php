<?php

namespace ProjetMVC\Model;

require_once __DIR__ . "/../../partials/_config.php";

class UserRepository
{
    private \PDO $pdo;

    public function getDb()
    {
        if (empty($this->pdo)) {
            try {
                $this->pdo = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                ]);
            } catch (\PDOException $e) {
                echo "Erreur de connexion BDD";
                exit;
            }
        }
        return $this->pdo;
    }

    public function __construct()
    {
        // echo "<h3>Instanciation du Model UserRepository</h3>";
        $this->getDb();
        // var_dump($this->pdo);
    }


    // Ci après, les méthodes qui interagissent avec la BDD
    // Le controller a le choix d'appeler une de ces méthodes
    // Il nous reste à développer celles pour add, update, delete 
    public function modelSelectAll()
    {
        // echo "<h3>On est dans la méthode modelSelectAll()!</h3>";

        // Le model ne se pose pas de question, il execute simplement ce qu'on lui demande et return la data
        // ATTENTION, il faut travailler avec prepare() :)  
        return $this->getDb()->query("SELECT * FROM employes")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function modelSelectOne($id)
    {
        return $this->getDb()->query("SELECT * FROM employes WHERE id_employes = $id")->fetch(\PDO::FETCH_ASSOC);
    }
}
