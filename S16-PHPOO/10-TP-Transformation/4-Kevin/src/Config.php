<?php

namespace ProjetKevin;

class Config
{
    const APP_NAME = "Inscription & Connexion Orienté Objet";

    private static array $settings = [
        "db_host" => "localhost",
        "db_name" => "dialogue",
        "db_user" => "root",
        "db_pass" => "root",
    ];

    public static function get($key)
    {
        if (isset(self::$settings[$key])) {
            return self::$settings[$key];
        }
        return null;
    }
}
