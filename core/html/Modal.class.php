<?php

  namespace Core\HTML;

  /**
   * Class Modal for
   * Easy html generating
   */
  class Modal
  {

      /**
       * The constructor of the Modal class
       * @return Void
       */
      public function __construct() {}


      public function getForm($form) {
        return $form;
      }

      /* ----------------------------------------- DELETE MUTUALISER--------------------------------------------- */

      public function deleteAction($args){
          if(validator::ifAjax() == TRUE){
              if(validator::ifArgs($args) !== FALSE){
                  session_start();

                  switch ($args['del']) {
                      case 'del_article':
                          //Suppression de l'article ET de son image
                          $article = new articles();
                          $art = $article->getOneBy(['id'=>$args['id']]);
                          $article->remove(['id'=>$args['id']]);
                          unlink('public/assets/img/articles/'.$art['img'].'');
                          unlink('public/assets/img/articles/thumbnails/thumb_'.$art['img'].'');
                          $link_art = new link_article_category();
                          $link_art->remove(['id_article'=>$args['id']]);
                          break;
                      case 'del_user':
                          //Suppression de l'utilisateur ET de son avatar
                          $user = new users();
                          $us = $user->getOneBy(['id'=>$args['id']]);
                          $user->remove(['id'=>$args['id']]);
                          unlink('public/assets/img/avatars/'.$us['avatar'].'');
                          unlink('public/assets/img/avatars/thumbnails/thumb_'.$us['avatar'].'');
                          break;
                      case 'del_category':
                          //Suppression de la categorie ET de son image
                          $category = new categories();
                          $cat = $category->getOneBy(['id'=>$args['id']]);
                          $category->remove(['id'=>$args['id']]);
                          unlink('public/assets/img/categories/'.$cat['img'].'');
                          unlink('public/assets/img/categories/thumbnails/thumb_'.$cat['img'].'');
                          break;

                      default:
                          'YOU DIE';
                          break;
                  }
              }else{
                  print_r("Impossible!!");
              }
          }else{
              print_r("Please try again. ");
          }
      }
    }
