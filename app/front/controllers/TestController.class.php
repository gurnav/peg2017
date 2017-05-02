<?php

  namespace App\Front\Controllers;

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
          echo "Index of test <br>";
      }

      public function populateAction()
      {
        $user = new Users();

        $user = $user->populate(['firstname' => 'Dudoux']);

        Helpers::debugVar($user);
      }

      public function subscribeAction() {
        $user = new Users();
        $user->setEmail("thomas.dudoux@gmail.com");
        $user->setPassword("Azerty123");
        $user->setFirstname("Dudoux");
        $user->setLastname("Thomas");
        $user->setUsername("PtitDoudoux");
        // $user->setPermission(2);
        $user->setStatus(0);
        $user->save();

        $v = new View();
        // $v->assign("nickname", $user->getNickname());
        $this->render($v, ["username" => $user->getUsername()]);
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

      public function formAction()
      {
        $form = new Form();
        echo $form->openForm('#');
        echo $form->input('text', 'name', 'name', 'p', 'Name');
        echo $form->submit();
        echo $form->closeForm();
      }

  }
