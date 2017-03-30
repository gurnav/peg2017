<?php

  define("HOST", "localhost");
  define('DS', DIRECTORY_SEPARATOR);
  define('PATH_RELATIVE', DS.'esgiGeographik'.DS);
  define('PATH_RELATIVE_PATTERN', '\/esgiGeographik'.DS);

  // define("DB_NAME", "esgiGeographik");
  define("DB_NAME", "esgiGeographik");
  define("DB_USER", "root");
  define("DB_PWD", "root");
  define("DB_HOST", HOST);
  define("DB_PORT", "3306");
  define("DB_DRIVER", "mysql");
  define("DB_PREFIX", "hbv_");

  define("ROOT", dirname(__DIR__) . PATH_RELATIVE);
