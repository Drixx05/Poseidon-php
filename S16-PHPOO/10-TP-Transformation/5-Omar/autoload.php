<?php

function inclusionAuto(string $class)
{
    $file = __DIR__ . "/Classes/" . $class . ".php";

    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register("inclusionAuto");