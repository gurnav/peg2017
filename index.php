<?php

  require "conf.inc.php";
  require "app/App.class.php";
  require_once "vendor/autoload.php";

  $app = new App();
  $app::load();

  Core\Util\Helpers::createLogExist();

  $routing = new Core\Route\Routing();
