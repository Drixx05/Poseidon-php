<?php

function inclusionAuto(string $class)
{
    $class = str_replace('\\', '/', $class);   
    $file = __DIR__ . "/src/" . $class . ".php";

    var_dump($file);

    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register("inclusionAuto");

?>