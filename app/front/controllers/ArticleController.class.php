<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Admin\Models\Users;
  use App\Admin\Models\Contents;

  class ArticleController extends Controller
  {
      public function indexAction($args)
      {
          if(validator::ifArgs($args) == TRUE){
              session_start();
              $v = new view();
              $url = implode ($args);
              $v->setViewFront("article");

              //Recupere les informations selon l'url de l'article
              $article = new Contents();
              $article_now = $article->getOneBy(['url'=>$url]);
              $v->assign('article_now', $article_now);

              //Recuperation des categories de l'article en cours
              $all_categories = new link_article_category();
              $article_categories = $all_categories->getName_Category($article_now['id']);
              $v->assign('article_categories', $article_categories);

              //Recupere le nom d'utilisateur ayant cree l'article selon l'id_user de l'article
              $user = new Users();
              $users = $user->getOneBy(['id'=>$article_now['id_user']]);
              $v->assign('users', $users);

              $three_last_articles = $article->getRand(['id'=>$article_now['id']], 3);
              $v->assign('three_last_articles', $three_last_articles);

              $like = new likes();
              $likes = $like->getAllBy(['id_article'=>$article_now['id']], [], '');
              $v->assign('likes', $likes);
          }else{
              header('Location: '.LINK_FRONT);
          }
      }

  }
