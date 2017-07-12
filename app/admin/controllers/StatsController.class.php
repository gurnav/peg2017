<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;

  class StatsController extends Controller
  {

    public function indexAction()
    {
        $v = new View('stats', 'admin');
    }

  }
