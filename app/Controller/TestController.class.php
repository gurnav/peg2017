<?php

  namespace App\Controller;

  use Core\Controller\Controller;
  use Core\View\View;
  use App\Models\Users;
  use Core\Util\Helpers;
  use Core\Facades\Query;

  class TestController extends Controller
  {
      public function indexAction()
      {
          echo "Index of test <br>";
      }

      public function populateAction()
      {
        $user = new Users();

        $user = $user->populate(['id' => 1]);


        Helpers::debugVar($user);
      }

      public function qbAction()
      {
        echo Query::select('*')->from('table', 'qb')->where('id=1');
      }
  }
