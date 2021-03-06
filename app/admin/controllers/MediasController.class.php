<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use Core\Views\View;
  use App\Admin\Models\Multimedias;
  use App\Composite\Factories\ModalsFactory;


  /**
   * Model Class who represent a media
   * in the database
   */
  class MediasController extends Controller
  {

      /**
       * Action who list all multimedias in database
       * @return Void
       */
      public function indexAction()
      {
          $v = new View('multimedias/multimedias', 'admin');

          $medias = Multimedias::getAll();

          $v->assign('medias', $medias);
      }

      /**
       * Action that allow an administrator to
       * manually add a medias
       * @return Void
       */
      public function addAction()
      {
          $v = new View('multimedias/add_multimedia', 'admin');

          $admin_add_multimedia_form = ModalsFactory::getAddMultimediasForm();

          $v->assign('admin_add_multimedia_form', $admin_add_multimedia_form);

          if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }
      }

      /**
       * Function for performing the add of the
       * multimedias on the server
       * @return Void
       */
      public function doAddAction()
      {
          $multimedia = new Multimedias();
          $_SESSION['errors'] = [];

          try {
            $multimedia->setName($_POST['filename']);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
            $multimedia->setPath($_FILES['file']);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
            $multimedia->setUsers_id(intval($_SESSION['user']['id']));
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if (empty($_SESSION['errors'])) $multimedia->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if(empty($_SESSION['errors']))
          {
             unset($_SESSION['errors']);
             header('Location: '.BASE_URL.'admin/medias');
          } else {
            header('Location: '.BASE_URL.'admin/medias/add');
          }
      }


      /**
       * Delete a media from the server and the Database
       * @param $img : String The image name on the server
       * @return Void
       */
      public function deleteAction($img)
      {
          $multimedia = new Multimedias();
          $img_id = trim($img[0]);

          try {
              $multimedia = $multimedia->populate(['id' => $img_id]);
              $multimedia->delete(true);
              unlink(UPLOADS_DIR_CONTENTS.$multimedia->getPath());
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }
          header('Location: '.BASE_URL.'admin/medias');
      }

  }
