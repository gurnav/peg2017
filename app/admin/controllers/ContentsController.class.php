<?php


  namespace App\Admin\Controllers;


  use App\Admin\Models\Users;
  use App\Admin\Models\Contents;
  use App\Admin\Models\Categories;
  use App\Admin\Models\Multimedias;
  use App\Composite\Factories\ModalsFactory;
  use Core\HTML\Modals;
  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;


  class ContentsController extends Controller
  {


    /**
     * Action who list all contents
     * @return Void
     */
    public function indexAction()
    {
        $v = new View('contents/contents', 'admin');
        $contents = Contents::getAllContentsWithUsersAndContents();

        $v->assign('contents', $contents);
    }

    /**
     * Function for searching in all content
     * @return Void
     */
    public function search()
    {
        $v = new View('contents/contents', 'admin');

        if (!empty($_POST['search'])) {
            $search = $_POST['search'];
        } else {
            header('Location: '.BASE_URL.'contents/contents');
        }

        $contents = Contents::searchInContents($search, $_POST['type'], $_POST['contents_type']);

        $v->assign('contents', $contents);
    }

    /**
     * Action that allow an administrator to
     * manually add a medias
     * @return Void
     */
    public function addAction()
    {
        $v = new View('contents/add_content', 'admin');

        $admin_register_content = ModalsFactory::getAddContentForm();

        $temp_categories = Categories::getAll();

        for ($i = 0; $i < sizeof($temp_categories); $i++) {
            $categories[$i]['name'] = $temp_categories[$i]['name'];
            $categories[$i]['value'] = $temp_categories[$i]['name'];
        }

        $admin_register_content['struct']['category']['value'] = $categories;

        if(!empty($_SESSION['addContent'])) {
            $admin_register_content['struct']['status']['selected'] = $_SESSION['addContent']['status'];
            $admin_register_content['struct']['title']['value'] = $_SESSION['addContent']['title'];
            $admin_register_content['struct']['category']['selected'] = $_SESSION['addContent']['category'];
            $admin_register_content['struct']['type']['selected'] = $_SESSION['addContent']['type'];
            $admin_register_content['struct']['content']['value'] = $_SESSION['addContent']['content'];
            unset($_SESSION['addContent']);
        }

        // $v->assign('categories', $categories);
        $v->assign('admin_register_content', $admin_register_content);

        if(isset($_SESSION['errors']) && !empty($_SESSION['errors']))
        {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }
      }

      /**
       * Action that allow an administrator to
       * manually update a contents
       * @return Void
       */
      public function updateAction($id_content)
      {

          $v = new View('contents/add_content', 'admin');

          $content = new Contents();
          $id_content = $id_content[0];
          $content = $content->populate(['id' => $id_content]);

          $admin_register_content = ModalsFactory::getUpdateContentForm($id_content);
          $admin_register_content['struct']['status']['selected'] = $content->getStatus();
          $admin_register_content['struct']['title']['value'] = $content->getTitle();
          $admin_register_content['struct']['category']['value'] = $content->getCategoryNameById();
          $admin_register_content['struct']['content']['value'] = $content->getContent();
          $admin_register_content['struct']['category']['selected'] = $content->getCategoryNameById($content->getCategories_id());
          $admin_register_content['struct']['thumbnails']['value'] = $content->getThumbnails_id();

          $temp_categories = Categories::getAll();

          for ($i = 0; $i < sizeof($temp_categories); $i++) {
              $categories[$i]['name'] = $temp_categories[$i]['name'];
              $categories[$i]['value'] = $temp_categories[$i]['name'];
          }

          $admin_register_content['struct']['category']['value'] = $categories;

          $v->assign('admin_register_content', $admin_register_content);

          if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }

      /**
       * Action that allow an administrator to
       * manually delete a contents
       * @return Void
       */
      public function deleteAction($id_content)
      {
          $content = new Contents();
          $id_content = trim($id_content[0]);
          try {
              $content = $content->populate(['id' => $id_content]);
              $content->delete();
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
          header('Location: '.BASE_URL.'admin/contents');
      }

      /**
       * Function for performing the update of the
       * multimedias on the server
       * @return Void
       */
      public function doUpdateAction($id_content)
      {
          $content = new Contents();
          $id_content = trim($id_content[0]);
          $_SESSION['errors'] = [];

          try {
              $content = $content->populate(['id' => $id_content]);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setTitle($_POST['title']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setCategories_id(intval($content->getCategoryIdByName($_POST['category'])));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setContent($_POST['content']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setStatus(intval($_POST['status']));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if ($_POST['thumbnails'] != '0') {
                  $content->setThumbnails_id(intval($_POST['thumbnails']));
              } else {
                  array_push($_SESSION['errors'], "You have to select a thumbnails");
              }
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


      /**
       * Function for performing the add of the
       * contents on the server
       * @return Void
       */
      public function doAddAction()
      {
          $content = new Contents();
          $_SESSION['errors'] = [];

          try {
              $content->setTitle($_POST['title']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setCategories_id(intval($content->getCategoryIdByName($_POST['category'])));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setContent($_POST['content']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setStatus(intval($_POST['status']));
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setType($_POST['type']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if ($_POST['thumbnails'] != '0') {
                  $content->setThumbnails_id(intval($_POST['thumbnails']));
              } else {
                  array_push($_SESSION['errors'], "You have to select a thumbnails");
              }
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $content->setUsers_id(intval($_SESSION["user"]["id"]));
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
              $_SESSION['addContent']['title'] = $_POST['title'];
              $_SESSION['addContent']['category'] = $_POST['category'];
              $_SESSION['addContent']['type'] = $_POST['type'];
              $_SESSION['addContent']['content'] = $_POST['content'];
              $_SESSION['addContent']['status'] = $_POST['status'];
              header('Location: '.BASE_URL.'admin/contents/add');
          }
      }

      /**
       * Function which implement a json array representing the gallery
       * for adding a thumbnail to a content
       */
      public function thumbnails_jsonAction()
      {
          header('Content-Type: application/json');
          $medias = Multimedias::getAll();

          for ($i = 0; $i < sizeof($medias); $i += 1) {
              $medias[$i]['path'] = ROUTE_DIR_CONTENTS.$medias[$i]['path'];
          }
          echo json_encode($medias);
      }

      /**
       * Function to brows file for ckeditor
       */
      public function browse_multimedias_ckeditorAction()
      {
          header('Content-Type: application/json');
          $medias = Multimedias::getAll();

          for ($i = 0; $i < sizeof($medias); $i += 1) {
              $images[$i]['image'] = ROUTE_DIR_CONTENTS.$medias[$i]['path'];
          }
          echo json_encode($images);
      }

  }
