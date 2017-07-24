<?php

  namespace App\Front\Controllers;

  use Core\Views\View;
  use App\Front\Models\Contents;
  use Core\Controllers\Controller;
  use Core\Util\Helpers;

  class IndexController extends Controller
  {
      public function indexAction($params = null)
      {
          $v = new View('index');

          $articles = Contents::getContentsWithUsers('article', 3);
          $news = Contents::getContentsWithUsers('news', 3);
          $pages = Contents::getContentsWithUsers('page', 3);

          $v->assign('articles', $articles);
          $v->assign('news', $news);
          $v->assign('pages', $pages);


          if (isset($_SESSION['msg'])) {
              $v->assign('msg', $_SESSION['msg']);
              unset($_SESSION['msg']);
          }
      }
  }
