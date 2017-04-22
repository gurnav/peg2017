<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;

  class CategoriesController extends Controller
  {

    public function indexAction()
    {

    }

      /* ----------------------------------------- PARTIE CATEGORIE --------------------------------------------- */

      public function ad_categoriesAction($args){
          session_start();
          $v = new view();
          $v->setView("add_category");

          $category = new categories();
          $all_cat = $category->getAll([], ['id'=>'ASC'], "");
          $v->assign('all_cat', $all_cat);

          //Formulaire d'ajout de categorie
          $all_forms = new all_forms();
          $form_add_cat = $all_forms->getFormAddCat();
          $errors = [];
          $v->assign("form_add_cat", $form_add_cat);
          $v->assign("errors", $errors);
      }

      public function update_categoryAction($args){
          if(validator::ifArgs($args) !== FALSE){
              session_start();

              $id = implode($args);

              $v = new view();
              $v->setView("update_category");

              //Recuperation des categories
              $category = new categories();
              $category_name = $category->getOneBy(['id'=>$id]);

              //Formulaire de modification d'article pre-rempli
              $all_forms = new all_forms();
              $form_modify_category = $all_forms->getFormModifCategory($category_name['id'], $_SESSION['pseudo'], $category_name['name_cat']);
              $errors = [];
              $v->assign("form_modify_category", $form_modify_category);
              $v->assign("errors", $errors);
          }else{
              header('Location: '.LINK_BACK);
          }
      }

    public function updateAction()
    {

    }
  }
