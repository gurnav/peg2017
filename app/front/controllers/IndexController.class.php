<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use App\Models\Users;
  use Core\Util\Helpers;

  class IndexController extends Controller
  {
      public function indexAction($params = null)
      {
          $v = new View();
      }

      public function welcomeAction()
      {
          echo "Welcome !<br>";
      }
  }
