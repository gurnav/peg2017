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
              $class = explode("\\", $class);
              for($i = 0; $i < count($class) - 1; $i += 1) {
                $class[$i] = lcfirst($class[$i]);
              }
              $class = implode(DS, $class);
              if (file_exists(__DIR__ . DS . $class . '.class.php')) {
                  require __DIR__ . DS . $class . '.class.php';
              }
          }
      }
}
