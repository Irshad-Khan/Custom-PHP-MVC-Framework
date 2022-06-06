<?php

    //Load Config
    require_once 'config/config.php';

    //Load all Libraries
    // require_once "libraries/Controller.php";
    // require_once "libraries/Core.php";
    // require_once "libraries/Database.php";
    // above libraries are good to load but if library increase
    // then it make beg file so use below code
    spl_autoload_register(function($className){
        require_once "libraries/".$className.".php";
    });