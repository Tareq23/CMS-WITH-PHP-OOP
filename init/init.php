<?php

session_start();

spl_autoload_register(function($class){
 $path = 'classes/'.$class.'.php';
    if(file_exists($path))
    {
        require_once $path;
    }
    else{
        require_once '../'.$path;
    }
});









