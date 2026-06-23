<?php 

// Pourquoi pas utiliser une classe Config plutôt qu'un bête fichier config.php ? 

// Exemple :

class Config {
    public const BASE_URL = "www.monsite.com";
    public const UPLOAD_PATH = '/www/uploads/';

    public const DB_NAME = "entreprise";
    public const DB_HOST = "localhost";
}

