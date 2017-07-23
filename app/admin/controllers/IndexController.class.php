<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use Core\Route\Routing;
  use Core\Facades\Auth;
  use App\Admin\Models\Users;
  use App\Admin\Models\Multimedias;
  use App\Admin\Models\Contents;
  use App\Admin\Models\Comments;


  class IndexController extends Controller
  {
      public function indexAction($params = null)
      {
          $v = new View('dashboard', 'admin');

          $users = Users::getAll();
          $multimedias = Multimedias::getAll();
          $comments = Comments::getAll();
          $contents = Contents::getAll();

          $v->assign('users', $users);
          $v->assign('multimedias', $multimedias);
          $v->assign('comments', $comments);
          $v->assign('contents', $contents);

      }

  }
