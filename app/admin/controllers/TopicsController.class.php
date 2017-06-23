<?php

  namespace App\Admin\Controllers;

  use App\Admin\Models\Topics;
  use Core\Controllers\Controller;
  use Core\Util\Helpers;
  use Core\Views\View;
  use App\Admin\Models\Users;
  use App\Composite\Factories\ModalsFactory;
  use Core\HTML\Modals;


  class TopicsController extends Controller
  {

    public function indexAction()
    {

        $v = new View('forum/topics'); // utiliser un template (admin)
        $topics = Topics::getAll();

        for($i =0;$i < count($topics);$i++)
        {
            $topics[$i]["username"] = Users::getUsernameById($topics[$i]["users_id"]);

        }

        $v->assign("topics", $topics);

    }

    public function addAction()
    {
        $v = new View ('forum/add_topic');

        $admin_register_topic = ModalsFactory::getAddTopicForm();
        if (!empty($_SESSION['addTopic'])) {
            $admin_register_topic['struct']['name']['value'] = $_SESSION['addTopic']['name'];
            $admin_register_topic['struct']['description']['value'] = $_SESSION['addTopic']['description'];
            unset($_SESSION['addTopic']);
        }
        $v->assign('admin_register_topic', $admin_register_topic);

        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {

            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);

        }
    }

      /**
       * Action that allow an administrator to
       * manually update a topics
       * @return Void
       */
      public function updateAction($id_topic)
      {

          $v = new View('forum/add_topic');

          $topic = new Topics();
          $id_topic = $id_topic[0];
          $topic = $topic->populate(['id' => $id_topic]);

          $admin_register_topic = ModalsFactory::getUpdateTopicForm($id_topic);
          $admin_register_topic['struct']['name']['value'] = $topic->getName();
          $admin_register_topic['struct']['description']['value'] = $topic->getDescription();

          $v->assign('admin_register_topic', $admin_register_topic);

          if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }

    public function deleteAction($id_topic)
    {

        $topic = new Topics();
        $id_topic = trim($id_topic[0]);
        try {
            $topic = $topic->populate(['id' => $id_topic]);
            $topic->delete();
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/topics');
    }


      /**
       * Function for performing the update of the
       * multimedias on the server
       * @return Void
       */
      public function doUpdateAction($id_topic)
      {
          $topic = new Topics();
          $id_topic = trim($id_topic[0]);
          $_SESSION['errors'] = [];
          try {
              $topic = $topic->populate(['id' => $id_topic]);
          } catch (Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $topic->setName($_POST['name']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $topic->setDescription($_POST['description']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if(empty($_SESSION['errors']))
                  $topic->save();
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
          // If no error login and send him / her on the home page
          if(empty($_SESSION['errors']))
          {
              unset($_SESSION['errors']);
              header('Location: '.BASE_URL.'admin/topics');
          } else {
              header('Location: '.BASE_URL.'admin/topics/update/'.$topic->getId());
          }
      }

      /**
       * Function for performing the add of the
       * contents on the server
       * @return Void
       */
      public function doAddAction()
      {

          $topic = new Topics();
          $_SESSION['errors'] = [];

          try {
              $topic->setName($_POST['name']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $topic->setDescription($_POST['description']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $topic->setUsers_id(intval($_SESSION['admin']['id']));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if(empty($_SESSION['errors']))
                  $topic->save();
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          // If no error login and send him / her on the inndex of topics
          if(empty($_SESSION['errors']))
          {
              unset($_SESSION['errors']);
              unset($_SESSION['addTopic']);
              header('Location: '.BASE_URL.'admin/topics');
          } else {
              $_SESSION['addTopic']['name'] = $_POST['name'];
              $_SESSION['addTopic']['description'] = $_POST['description'];
              header('Location: '.BASE_URL.'admin/topics/add');
          }
      }

  }

 /* Helpers::debugVar($topic);
  Helpers::debugVar($_SESSION);
  die();*/
