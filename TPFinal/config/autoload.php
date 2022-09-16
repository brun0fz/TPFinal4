<?php
spl_autoload_register(function ($className)
{
    $classPath = dirname(__DIR__) ."/" . str_replace("\\", "/", $className)  . ".php";
    include_once($classPath);
});
?>