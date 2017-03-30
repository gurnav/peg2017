<?php

  namespace Core;

/**
   * Class who autoload class called
   */
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
       * @return void
       */
      public static function autoload($called)
      {
          if (strpos($called, __NAMESPACE__ . '\\') === 0)
          {
              $called = str_replace(__NAMESPACE__ . '\\', '', $called);
              $called = str_replace('\\', DS, $called);
              $called = lcfirst($called);
              if (file_exists(__DIR__ . DS . $called . '.class.php')) {
                  require __DIR__ . DS . $called . '.class.php';
              }
          }
      }
  }
