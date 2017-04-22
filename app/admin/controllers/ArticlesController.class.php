<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;

  class ArticlesController extends Controller
  {

    public function indexAction()
    {
        session_start();
        $v = new view();
        $v->setView("administration");

        $articles = new articles();
        $all_articles = $articles->getAll([],[], '');
        $v->assign('articles', $all_articles);
    }

    public function addAction($args){
      session_start();
      $v = new view();
      $v->setView("add_article");

      //SECTION articles - affiche tous les articles en base
      $articles = new articles();
      $three_last_article = $articles->getAll([],['id'=>'ASC'], '');
      $v->assign('three_last_article', $three_last_article);

      //Recuperation des noms d'utilisateurs pour chaque article
      foreach ($three_last_article as $key => $value) {
          $us = new users();
          $users = $us->getOneBy(['id'=>$value['id_user']]);

          $pseudo_article[$key]['pseudo'] = $users['pseudo'];
      }

      $v->assign('pseudo_article', $pseudo_article);

      //Recuperation des categories pour l'ajout d'article
      $category = new categories();
      $category_article_name = $category->getAll([], [], "");

      foreach ($category_article_name as $key => $value) {
          $category_article_name[$key] = $value['name_cat'];
      }

      //Formulaire d'ajout d'article
      $all_forms = new all_forms();
      $form_add_article = $all_forms->getFormAddArticle();
      $errors = [];
      $v->assign("form_add_article", $form_add_article);
      $v->assign("errors", $errors);
      $v->assign("category_article_name", $category_article_name);

    }

    public function updateAction($args)
    {
      if(validator::ifArgs($args) !== FALSE){
          session_start();
          $v = new view();
          $v->setView("update_article");
          $id = implode($args);

          $article = new articles();
          $article_current = $article->getOneBy(['id'=>$id]);

          //Recuperation des categories
          $category = new categories();
          $category_article_name = $category->getAll([], [], "");

          foreach ($category_article_name as $key => $value) {
              $category_article_name[$key] = $value['name_cat'];
          }

          $v->assign("category_article_name", $category_article_name);

          //Formulaire de modification d'article pre-rempli
          $all_forms = new all_forms();
          $form_modif_article = $all_forms->getFormModifArticle($article_current['id'], $article_current['img'], $_SESSION['pseudo'], $article_current['title'], $article_current['content']);
          $errors = [];
          $v->assign("form_modif_article", $form_modif_article);
          $v->assign("errors", $errors);
      }else{
          header('Location: add_articles/');
      }
    }
  }
