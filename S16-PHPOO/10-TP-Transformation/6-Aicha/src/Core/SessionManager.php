<?php namespace Core;

class SessionManager {

    public static function start()
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    public static function destroy() 
    {
        session_destroy();
    }

    public static function set(string $key, mixed $value) 
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

}

?>