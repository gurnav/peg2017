<?php

// namespace App;

// TODO use Core\Config;

/**
 * Class that load the app
 * this class also configure it
 * This class have to be instanciate one and only time
 */
class App
{
    public static $title = "ESGI-Geographic";
    private static $_instance;
    public static $prefix = "front";


    /**
     * Get of the instance of the class
     * Needed cause there is only on instance of this class
     * @return $instance : App The instance of this class in memory
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * Load the needed dependencies of the Web applications
     * @return Void
     */
    public static function load()
    {
        session_start();
        require ROOT . 'app' . DS . 'Autoloader.class.php';
        App\Autoloader::register();
        require ROOT . 'core' . DS . 'Autoloader.class.php';
        Core\Autoloader::register();
    }

    /**
     * App prefix setter
     * @param String: $prefix The prefix to be set
     * @return Void
     */
    public static function setPrefix($prefix)
    {
        self::$prefix = $prefix;
    }

}
