<?php

  namespace App\Admin\Controllers;

  use App\Admin\Models\Topics;
  use Core\Controllers\Controller;
  use Core\Views\View;
  use App\Admin\Models\Users;
  use App\Composite\Factories\ModalsFactory;


  class TopicsController extends Controller
  {

    public function indexAction()
    {

        $v = new View('forum/topics');
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

    public function updateAction()
    {

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




      public function doAddAction()
      {
          $topic = new Topics();
          $_SESSION['errors'] = [];
          foreach ($_POST as $post => $value) {
              $cleanedData[$post] = Helpers::cleanString($value);
          }

          try {
              $topic->setName($cleanedData['name']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
          try {
              $topic->setDescription($cleanedData['description']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
       /*  try {
              $topic->setUsers_id(intval($topic->getUsernameById($cleanedData['user'])));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }*/


          // If no error login and send him / her on the home page
          if(empty($_SESSION['errors']))
          {
              unset($_SESSION['errors']);
              unset($_SESSION['addTopic']);
              header('Location: '.BASE_URL.'admin/topics');
          } else {
              $_SESSION['addTopic']['name'] = $cleanedData['name'];
              $_SESSION['addTopic']['description'] = $cleanedData['description'];
             // $_SESSION['addTopic']['user_id'] = $cleanedData['user'];

              header('Location: '.BASE_URL.'admin/topics/add');
          }
      }

  }
