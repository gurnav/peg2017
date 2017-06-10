<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Admin\Models\Contents;
  use App\Composite\Factories\ModalsFactory;
  use Core\HTML\Modals;
  use App\Admin\Models\Users;

  class ContentsController extends Controller
  {

    public function indexAction()
    {
        $v = new View('contents/contents');
        $contents = Contents::getAll();

        for($i = 0; $i < count($contents); $i += 1)
        {
            $contents[$i]["username"] = Users::getUsernameById($contents[$i]["users_id"]);
        }

        $v->assign('contents', $contents);
    }

      public function addAction()
      {
          $v = new View('contents/add_content');

          $admin_register_content = ModalsFactory::getAddContentForm();
          if(!empty($_SESSION['addContent'])) {
              $admin_register_content['struct']['status']['value'] = $_SESSION['addContent']['status'];
              $admin_register_content['struct']['title']['value'] = $_SESSION['addContent']['title'];
              $admin_register_content['struct']['category']['value'] = $_SESSION['addContent']['category'];
              $admin_register_content['struct']['content']['value'] = $_SESSION['addContent']['content'];
              unset($_SESSION['addContent']);
          }

          $v->assign('admin_register_content', $admin_register_content);

          if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }

      public function updateAction($id_content)
      {

          $v = new View('contents/add_content');

          $content = new Contents();
          $id_content = $id_content[0];
          $content = $content->populate(['id' => $id_content]);

          $admin_register_content = ModalsFactory::getUpdateContentForm($id_content);
          $admin_register_content['struct']['status']['value'] = $content->getStatus();
          $admin_register_content['struct']['title']['value'] = $content->getTitle();
          $admin_register_content['struct']['category']['value'] = $content->getCategoryNameById();
          $admin_register_content['struct']['content']['value'] = $content->getContent();

          $v->assign('admin_register_content', $admin_register_content);

          if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }

      public function deleteAction($id_content)
      {
          $content = new Contents();
          $id_content = trim($id_content[0]);
          try {
              $content = $content->populate(['id' => $id_content]);
              $content->delete();
          } catch (Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
          header('Location: '.BASE_URL.'admin/contents');
      }

      public function doUpdateAction($id_content)
      {
          $content = new Contents();
          $id_content = trim($id_content[0]);
          $_SESSION['errors'] = [];

          foreach ($_POST as $post => $value) {
              $cleanedData[$post] = Helpers::cleanString($value);
          }

          try {
              $content = $content->populate(['id' => $id_content]);
          } catch (Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setTitle($cleanedData['title']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setCategories_id(intval($content->getCategoryIdByName($cleanedData['category'])));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setContent($cleanedData['content']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setStatus(intval($cleanedData['status']));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if(empty($_SESSION['errors']))
                  $content->save();
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          // If no error login and send him / her on the home page
          if(empty($_SESSION['errors']))
          {
              unset($_SESSION['errors']);
              header('Location: '.BASE_URL.'admin/contents');
          } else {
              header('Location: '.BASE_URL.'admin/contents/update/'.$content->getId());
          }
      }

      public function doAddAction()
      {
          $content = new Contents();
          $_SESSION['errors'] = [];

          foreach ($_POST as $post => $value) {
              $cleanedData[$post] = Helpers::cleanString($value);
          }

          /*$contentExist = $content->userExist($cleanedData['username'], $cleanedData['user_email']);

          if (!empty($contentExist)) {
              $_SESSION['errors'] = $contentExist;
              header('Location: '.BASE_URL.'admin/contents');
          }*/

          try {
              $content->setTitle($cleanedData['title']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setCategories_id(intval($content->getCategoryIdByName($cleanedData['category'])));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setContent($cleanedData['content']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setStatus(intval($cleanedData['status']));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setUsers_id(intval($_SESSION["admin"]["id"]));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if(empty($_SESSION['errors']))
                  $content->save();
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          // If no error login and send him / her on the home page
          if(empty($_SESSION['errors']))
          {
              unset($_SESSION['errors']);
              unset($_SESSION['addContent']);
              header('Location: '.BASE_URL.'admin/contents');
          } else {
              $_SESSION['addContent']['title'] = $cleanedData['title'];
              $_SESSION['addContent']['category'] = $cleanedData['category'];
              $_SESSION['addContent']['content'] = $cleanedData['content'];
              $_SESSION['addContent']['status'] = $cleanedData['status'];
              header('Location: '.BASE_URL.'admin/contents/add');
          }
      }

  }
