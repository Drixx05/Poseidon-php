<?php namespace Core;

class Config {
    
    public static $settings = [
        "debug_mode"     => true,
        "db_host"        => "localhost",
        "db_name"        => "user",
        "db_table" => "utilisateurs"
    ];

    public static function setSetting($key, $value)
    {
        self::$settings[$key] = $value;
    }

    public static function getSetting($key)
    {
        return self::$settings[$key] ?? "Cette clé n'existe pas";
    }

}

?>