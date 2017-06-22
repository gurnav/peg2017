<?php

  define("HOST", "localhost");
  define('DS', DIRECTORY_SEPARATOR);
  define('PATH_RELATIVE', DS.'esgi-geographic'.DS);
  define('PATH_RELATIVE_PATTERN', '\/esgi-geographic');

  define("DB_NAME", "esgiGeographik");
  define("DB_USER", "root");
  define("DB_PWD", "");
  define("DB_HOST", HOST);
  define("DB_PORT", "3306");
  define("DB_DRIVER", "mysql");
  define("DB_PREFIX", "hbv_");

  define("BASE_URL", "http://127.0.0.1/esgi-geographic/");
  define("ROOT", dirname(__DIR__) . PATH_RELATIVE);

    /* LINK which point to the public directory */
    define("LINK_IMG", "http://localhost/esgi-geographic/app/public/assets/images/");
    define("LINK_CSS", "http://localhost/esgi-geographic/app/public/assets/css/");
    define("LINK_JS", "http://localhost/esgi-geographic/app/public/assets//js/");

    /* LINK which point to the controllers */
    define("LINK_FRONT", "http://localhost/esgi-geographic/");
    define("LINK_ARTICLE", "http://localhost/esgi-geographic/article/");
    define("LINK_CATEGORY", "http://localhost/esgi-geographic/categories/");
    define("LINK_USER", "http://localhost/esgi-geographic/users/");

    /* LINK for handling upload */
    define("ROUTE_DIR_CONTENTS", BASE_URL."uploads/contents/");
    define("UPLOADS_DIR_CONTENTS", ROOT."uploads/contents/");
    define("ROUTE_DIR_USERS", BASE_URL."uploads/users/");
    define("UPLOADS_DIR_USERS", ROOT."uploads/users/");

    // WTF
    $errors_msg = [
        // Formulaire accueil
        "name"=>"Your mail isn't correct.",
        "company"=>"Your company's name need to be upper than 2 letters.",
        "email"=>"Your mail is needed",
        "content"=>"Need content"
    ];
