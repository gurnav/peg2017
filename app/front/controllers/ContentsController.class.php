<?php

  namespace App\Front\Controllers;

  use App\Composite\Factories\ModalsFactory;
  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Front\Models\Contents;
  use App\Front\Models\Comments;

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

          $contents = Contents::getContentsWithUsers();
          $v->assign('search_form', ModalsFactory::getSearchForm());
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

          $contents = Contents::getContentsWithUsers('article');
          $v->assign('search_form', ModalsFactory::getSearchForm());
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

          if (isset($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }


      /**
       * Action for listing all the articles in the site
       * @return Void
       */
      public function all_newsAction()
      {
          $v = new View('contents/all_contents');

          $contents = Contents::getContentsWithUsers('news');
          $v->assign('search_form', ModalsFactory::getSearchForm());
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

          if (isset($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }


      /**
       * Action for listing all the articles in the site
       * @return Void
       */
      public function all_pagesAction()
      {
          $v = new View('contents/all_contents');

          $contents = Contents::getContentsWithUsers('page');
          $v->assign('search_form', ModalsFactory::getSearchForm());
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

          if (isset($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }

      /**
       * Send A comment in front with CKEDITOR
       */
      public function sendCommentAction()
      {

          if (!empty($_POST['content'])) {

              $comments = new Comments();

              $comment_content = html_entity_decode($_POST['content']);
              $comment_content = strip_tags($comment_content, "<p><a><b><ul><li><ol><u><i><h1><h2>
              <h3><h4><h5><h6><br><div><hr><table><tbody><td><tr><tfoot><th><thead><strong><em>");

              try {
                  $comments->setContent($comment_content);
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }

              try {
                  $comments->setContents_id(intval($_POST['content_id']));
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }

              try {
                  $comments->setUsers_id(intval($_SESSION['user']['id']));
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }

              try {
                  if (!isset($_SESSION['errors'])) $comments->save();
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }

          } else {
              array_push($_SESSION['errors'], "You can't post an empty comment");
          }

          $url = (!isset($_SERVER["HTTP_REFERER"]))?BASE_URL:$_SERVER["HTTP_REFERER"];
          header('Location: '.$url);

      }

      /**
       * Function for searching in all content
       * @return Void
       */
      public function searchAction()
      {
          $v = new View('contents/all_contents');

          if (!empty($_POST['search'])) {
              $search = $_POST['search'];
          } else {
              header('Location: '.BASE_URL.'contents/all_contents');
          }

          $contents = Contents::searchInContents($search, $_POST['type'], $_POST['contents_type']);

          $v->assign('search_form', ModalsFactory::getSearchForm());
          $v->assign('type', 'contents');
          $v->assign('contents', $contents);

      }

  }
