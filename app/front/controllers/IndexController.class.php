<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use App\Models\Users;
  use Core\Util\Helpers;

  class IndexController extends Controller
  {
      public function indexAction($params = null)
      {
          $v = new view();
          $v->setView("index");
/*
          //SECTION articles - affiche les 3 derniers en base
          $articles = new articles();
          $three_last_article = $articles->getAll([],['id'=>'DESC'], 3);
          $v->assign('three_last_article', $three_last_article);

          //Recuperation des noms d'utilisateurs pour chaque article cree sur la page
          foreach ($three_last_article as $key => $value) {
              $us = new users();
              $users = $us->getOneBy(['id'=>$value['id_user']]);

              $pseudo_article[$key]['pseudo'] = $users['pseudo'];
          }

          $v->assign('pseudo_article', $pseudo_article);
*/

      }
  }
