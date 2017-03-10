<?php

// use Core\Config;

class App
{
    public $title = "esgiGeographik";
    private static $_instance;

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function load()
    {
        session_start();
        require ROOT . 'app/Autoloader.class.php';
        App\Autoloader::register();
        require ROOT . 'core/Autoloader.class.php';
        Core\Autoloader::register();
    }
}
