<?php

/* 

Exercice 1 : Configuration d'une classe Config avec static, self et const

Objectif : Créer une classe Config pour gérer la configuration générale d'une application web. Cette classe contiendra des constantes et des méthodes statiques permettant d'accéder aux informations comme le nom de l'application et les paramètres globaux.

Énoncé :

    Créez une classe Config qui contiendra :
        Une constante APP_NAME qui stockera le nom de l'application.
        Une propriété statique $settings qui contiendra les paramètres globaux de l'application sous forme de key=>value (comme le mode de débogage, ou l'URL de la base de données, mettez des infos aléatoires).
        Une méthode statique setSetting($key, $value) pour ajouter une valeur dans $settings.
        Une méthode statique getSetting($key) pour récupérer une valeur de $settings.
        Une méthode statique getAppName() qui retourne le nom de l'application.

*/ 

class Config
{
    const APP_NAME = "MonApplication";

    public static $settings = [
        "debug" => true,
        "db_url" => "localhost",
    ];

    public static function setSetting($key, $value)
    {
        self::$settings[$key] = $value;
    }

    public static function getSetting($key)
    {
        if (isset(self::$settings[$key])) {
            return self::$settings[$key];
        }
        return null;
    }

    public static function getAppName()
    {
        return self::APP_NAME;
    }
}

echo "Nom de l'app : " . Config::getAppName();
echo "On check le setting db_url : " . Config::getSetting("db_url");
echo "<hr>";
echo "On check un setting inexistant : " . Config::getSetting("db");

Config::setSetting("db_user" , "pierra");
echo "On check un setting db_user : " . Config::getSetting("db_user");

var_dump(Config::$settings);








?>