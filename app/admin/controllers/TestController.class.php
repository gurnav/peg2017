<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use App\Front\Models\Users;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Auth\DBAuth;
  use Core\HTML\Form;

  class TestController extends Controller
  {
      public function indexAction()
      {
          echo "Index of test admin<br>";
      }

      public function populateAction()
      {
        $user = new Users();

        $user = $user->populate(['firstname' => 'Dudoux']);

        Helpers::debugVar($user);
      }

  }
