<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Front\Models\Contents;

  /**
   * Controller for contents related actions
   */
  class ContentsController extends Controller
  {

      /**
       * Action for listing all the contents in the site
       * @return Void
       */
      public function indexAction()
      {
          $v = new View('contents/all_contents');
          $contents = Contents::getAll(true);
          $v->assign('contents', $contents);
          $v->assign('type', 'contents');
      }

      /**
       * Action for listing all the articles in the site
       * @return Void
       */
      public function all_articlesAction()
      {
          $v = new View('contents/all_contents');
          $contents = Contents::getAllByType('article', true);
          $v->assign('contents', $contents);
          $v->assign('type', 'articles');
      }


      /**
       * Action for showing an article
       * @param String $id_news : The id of the researched article*
       * @return Void
       */
      public function articleAction($id_article)
      {
          $v = new View('contents/content');
          $content = new Contents();

          $content = $content->populate(['id' => $id_article[0]]);
          $comments = $content->getAllCommentsFromContentID();

          $v->assign('content', $content);
          $v->assign('comments', $comments);
      }


      /**
       * Action for listing all the articles in the site
       * @return Void
       */
      public function all_newsAction()
      {
          $v = new View('contents/all_contents');
          $contents = Contents::getAllByType('news', true);
          $v->assign('contents', $contents);
          $v->assign('type', 'news');
      }


      /**
       * Action for showing a news
       * @param String $id_news : The id of the researched news
       * @return Void
       */
      public function newsAction($id_news)
      {
          $v = new View('contents/content');
          $content = new Contents();

          $content = $content->populate(['id' => $id_news[0]]);
          $comments = $content->getAllCommentsFromContentID();

          $v->assign('content', $content);
          $v->assign('comments', $comments);
      }


      /**
       * Action for listing all the articles in the site
       * @return Void
       */
      public function all_pagesAction()
      {
          $v = new View('contents/all_contents');
          $contents = Contents::getAllByType('page', true);
          $v->assign('contents', $contents);
          $v->assign('type', 'pages');
      }


      /**
       * Action for showing a page
       * @param String $id_news : The id of the researched page
       * @return Void
       */
      public function pageAction($id_page)
      {
          $v = new View('contents/content');
          $content = new Contents();

          $content = $content->populate(['id' => $id_page[0]]);
          $comments = $content->getAllCommentsFromContentID();

          $v->assign('content', $content);
          $v->assign('comments', $comments);
      }

  }
