<?php

namespace App\Front\Controllers;

use App\Admin\Models\Topics;
use App\Front\Models\Messages;
use App\Front\Models\Threads;
use App\Composite\Models\Thread;
use Core\Controllers\Controller;
use Core\Util\Helpers;
use Core\Views\View;
use App\Admin\Models\Users;
use App\Composite\Factories\ModalsFactory;
use Core\HTML\Modals;
use App\Composite\Traits\Models\GetAllDataTrait;


  class ForumController extends Controller
  {

      public function indexAction()
      {

          $v = new View('forum/home');
          $topics = Topics::getAllTopicsWithUsers();
          $threads = Threads::getAllThreadsWithUsers();

         $v->assign("topics", $topics);
         $v->assign("threads", $threads);
      }

     public static function topic_detailAction($id_topic)
      {

          $v = new View('forum/topic_detail');
          $topics = Topics::getAllTopicsWithUsers($id_topic[0], true);
          $threads = Threads::getThreadByTopicIdWithUser($id_topic[0]);

          $v->assign("topics", $topics);
          $v->assign("threads", $threads);

      }

    public function thread_detailAction($id_thread)
    {

        $v = new View('forum/thread_detail');

        $threads = Threads::getAllThreadsWithUsers($id_thread[0], true);
        $messages = Messages::getAllMessagesByThreadIdWithUser($id_thread[0]);

        $v->assign('threads', $threads);
        $v->assign('messages', $messages);

    }


      public function sendMessageAction()
      {

          if (!empty($_POST['message'])) {

              $message = new Messages();

              $message_content = html_entity_decode($_POST['message']);
              $message_content = strip_tags($message_content, "<p><a><b><ul><li><ol><u><i><h1><h2>
              <h3><h4><h5><h6><br><div><hr><table><tbody><td><tr><tfoot><th><thead><strong><em>");

              try {
                  $message->setContent($message_content);
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }
              try {
                  $message->setThreadsId(intval($_POST['thread_id']));
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }
              try {
                  $message->setUsers_id(intval($_SESSION['user']['id']));
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }
              try {
                  if (!isset($_SESSION['errors'])) $message->save();
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }

          } else {
              array_push($_SESSION['errors'], "You can't post an empty comment");
          }
          $url = (!isset($_SERVER["HTTP_REFERER"]))?BASE_URL:$_SERVER["HTTP_REFERER"];
          header('Location: '.$url);
      }

      public function sendThreadAction()
      {

          if (!empty($_POST['title'] && $_POST['description'])) {

              $message = new Threads();

              $thread_title = html_entity_decode($_POST['title']);
              $thread_title = strip_tags($thread_title, "<p><a><b><ul><li><ol><u><i><h1><h2>
              <h3><h4><h5><h6><br><div><hr><table><tbody><td><tr><tfoot><th><thead><strong><em>");

              $thread_description = html_entity_decode($_POST['description']);
              $thread_description = strip_tags($thread_description, "<p><a><b><ul><li><ol><u><i><h1><h2>
              <h3><h4><h5><h6><br><div><hr><table><tbody><td><tr><tfoot><th><thead><strong><em>");

              try {
                  $message->setTitle($thread_title);
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }
              try {
                  $message->setDescription($thread_description);
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }

              try {
                  $message->setTopicsId(intval($_POST['topic_id']));
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }
              try {
                  $message->setUsers_id(intval($_SESSION['user']['id']));
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }
              try {
                  if (!isset($_SESSION['errors'])) $message->save();
              } catch (\Exception $e) {
                  array_push($_SESSION['errors'], $e->getMessage());
              }

          } else {
              array_push($_SESSION['errors'], "You can't post an empty comment");
          }
          $url = (!isset($_SERVER["HTTP_REFERER"]))?BASE_URL:$_SERVER["HTTP_REFERER"];
          header('Location: '.$url);
      }

      public function deleteMessageAction($id_message)
      {
          $message = new Messages();
          $id_message = trim($id_message[0]);
          try {
              $message = $message->populate(['id' => $id_message]);
              $message->delete();
          } catch (Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
          $url = (!isset($_SERVER["HTTP_REFERER"]))?BASE_URL:$_SERVER["HTTP_REFERER"];
          header('Location: '.$url);

      }

      public function reportMessageAction($id_message)
      {
          $message = new Messages();
          $id_message = trim($id_message[0]);
          try {
              $message = $message->populate(['id' => $id_message]);
              $message->setSignaled(1);
              $message->save();
          } catch (Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
          $url = (!isset($_SERVER["HTTP_REFERER"]))?BASE_URL:$_SERVER["HTTP_REFERER"];
          header('Location: '.$url);

      }

  }
