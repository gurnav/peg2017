<?php

  namespace App\Controller;

  use Core\Controller\Controller;
  use Core\View\View;
  use App\Models\Users;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Auth\DBAuth;

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

      public function loginAction()
      {
        echo "Test of connection ! \n\n";
        $login = new DBAuth();
        $login->login("PtitDoudoux", "Azerty123");
         if (!empty($login->logged()) ) {
           echo "You're logged ! \n\n";
         } else {
           echo "You're not logged ! \n\n";
         }
         Helpers::debugVar($login);
      }

  }
