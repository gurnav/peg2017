<?php

  namespace App\Front\Controller;

  use Core\Controller\Controller;
  use Core\View\View;
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
