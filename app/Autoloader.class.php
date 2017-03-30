<?php

namespace App;

class Autoloader
{

      /**
       * Save our autoloader
       */
      public static function register()
      {
          spl_autoload_register(array(__CLASS__, 'autoload'));
      }

      /**
       * Include the files corresponding to our class
       * @param $class : String The name of the class to load
       */
      public static function autoload($class)
      {
          if (strpos($class, __NAMESPACE__ . '\\') === 0) {
              $class = str_replace(__NAMESPACE__ . '\\', '', $class);
              $class = str_replace('\\', '/', $class);
              $class = lcfirst($class);
              if (file_exists(__DIR__ . '/' . $class . '.class.php')) {
                  require __DIR__ . '/' . $class . '.class.php';
              }
          }
      }
}
