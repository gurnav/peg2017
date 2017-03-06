<?php

  require "conf.inc.php";
  require "app/App.class.php";

  $app = new App();
  $app::load();
  
  Core\Util\Helpers::createLogExist();


  $routing = new Core\Route\Routing();

  Core\Util\Helpers::debugVar($routing);
