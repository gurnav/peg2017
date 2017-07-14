<?php

  define("HOST", "localhost");
  define('DS', DIRECTORY_SEPARATOR);
  define('PATH_RELATIVE', DS.'esgi-geographic'.DS);
  define('PATH_RELATIVE_PATTERN', '\/esgi-geographic');

  define("SITE_NAME", "esgi-geographic");

  define("DB_NAME", "esgiGeographik");
  define("DB_USER", "root");
  define("DB_PWD", "root");
  define("DB_HOST", HOST);
  define("DB_PORT", "3306");
  define("DB_DRIVER", "mysql");
  define("DB_PREFIX", "hbv_");

  define("BASE_URL", "http://127.0.0.1/esgi-geographic/");
  define("ROOT", dirname(__DIR__) . PATH_RELATIVE);

  /* LINK for handling upload */
  define("ROUTE_DIR_CONTENTS", BASE_URL."uploads/contents/");
  define("UPLOADS_DIR_CONTENTS", ROOT."uploads/contents/");
  define("ROUTE_DIR_USERS", BASE_URL."uploads/users/");
  define("UPLOADS_DIR_USERS", ROOT."uploads/users/");

  define("BASE_AVATAR", "avatar.png");
