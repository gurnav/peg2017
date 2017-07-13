<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use App\Models\Users;
  use App\Front\Controllers;
  use Core\Util\Helpers;

  class IndexController extends Controller
  {
      public function indexAction($params = null)
      {
          $v = new View('index');

          if (isset($_SESSION['msg'])) {
              $v->assign('msg', $_SESSION['msg']);
              unset($_SESSION['msg']);
          }
      }
  }
