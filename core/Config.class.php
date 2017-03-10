<?php

  namespace Core;

  /**
   * Config class who load a special config once
   * May change to load multiple conf in the future
   */
  class Config {

      private $settings = []; // Array of called settings
      private static $_instance; // Instance of our Singleton

      public function __construct($file) {
        $this->settings = require($file);
      }

      /**
       * Get the instance of our Singleton
       */
      public static function getInstance($file) {
        if(is_null(self::$_instance))
          self::$_instance = new Config($file);
        return self::$_instance;
      }

      /**
       * Get a config properties
       */
      public function get($key) {
        if (!isset($this->settings[$key]))
          return null;
        return $this->settings[$key];
      }

  }
