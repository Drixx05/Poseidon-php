<?php 

// Plutot que d'utiliser les instructions natives de la session, pourquoi pas regrouper ça dans une classe ? 

class SessionManager 
{
    public static function start() 
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy() 
    {
        session_destroy();
    }

    public static function set(string $key, mixed $value) 
    {
        $_SESSION[$key] = $value;
    }
}

SessionManager::start();
SessionManager::destroy();
SessionManager::set("role", "admin");
