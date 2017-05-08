<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use App\Front\Models\Users;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Auth\DBAuth;
  use App\Admin\Models\Contents;

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

      public function queryAction()
      {
        $attributes = ['id', 'title', 'status', 'type', 'date_inserted'];
        $users_attributes = ['username'];
        Helpers::debugVar(Contents::getAllWithUsers('contents', $attributes, $users_attributes));

      }

  }
