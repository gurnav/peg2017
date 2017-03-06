<?php

  namespace App\Controller;

  use Core\Controller\Controller;
  use Core\View\View;
  use App\Models\Users;
  use Core\Util\Helpers;

  class IndexController extends Controller {

    public function indexAction($params = null) {

      $user = new Users();
      $user->setEmail("thomas.dudoux@gmail.com");
      $user->setPassword("Azerty123");
      $user->setFirstname("Dudoux");
      $user->setLastname("Thomas");
      $user->setNickname("PtitDoudoux");
      // $user->setPermission(2);
      $user->setStatus(0);
      $user->save();

      $v = new View();
      // $v->assign("nickname", $user->getNickname());
      $this->render($v, ["nickname" => $user->getNickname()]);
    }

    public function welcomeAction() {
      echo "Welcome !<br>";
    }

  }
