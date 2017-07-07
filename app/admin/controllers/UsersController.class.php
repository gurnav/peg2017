<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Database\Models;
  use App\Admin\Models\Users;
  use App\Composite\Factories\ModalsFactory;

  /**
   * Controller for managing user in
   * the back end
   */
  class UsersController extends Controller
  {

    /**
     * Action who list all users
     * @return Void
     */
    public function indexAction()
    {
      $v = new View('users/users', 'admin');
      $users = Users::getAll(true);

      $v->assign('users', $users);

      if(!empty($_SESSION['errors'])) {
        $v->assign('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);
      }

    }

    /**
     * Action that allow an administrator to
     * manually add a user
     * @return Void
     */
    public function addAction()
    {
      $v = new View('users/add_user', 'admin');

      $admin_add_user_form = ModalsFactory::adminAddUserForm();
      if(!empty($_SESSION['addUSer'])) {
        $admin_add_user_form['struct']['user_email']['value'] = $_SESSION['addUSer']['user_email'];
        $admin_add_user_form['struct']['username']['value'] = $_SESSION['addUSer']['username'];
        $admin_add_user_form['struct']['firstname']['value'] = $_SESSION['addUSer']['firstname'];
        $admin_add_user_form['struct']['lastname']['value'] = $_SESSION['addUSer']['lastname'];
        $admin_add_user_form['struct']['user_status']['checked'] = $_SESSION['addUSer']['user_status'];
        $admin_add_user_form['struct']['user_rights']['checked'] = $_SESSION['addUSer']['user_rights'];
        unset($_SESSION['addUser']);
      }

      $v->assign('admin_add_user_form', $admin_add_user_form);

      if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
          $v->assign('errors', $_SESSION['errors']);
          unset($_SESSION['errors']);
      }
    }

    /**
     * Action that allow an administrator to
     * manually update a user
     * @return Void
     */
    public function updateAction($user_id)
    {

      $v = new View('users/add_user', 'admin');

      $user = new Users();
      $user_id = $user_id[0];
      $user = $user->populate(['id' => $user_id]);

      $admin_add_user_form = ModalsFactory::adminUpdateUserForm($user_id);
      $admin_add_user_form['struct']['user_email']['value'] = $user->getEmail();
      $admin_add_user_form['struct']['username']['value'] = $user->getUsername();
      $admin_add_user_form['struct']['firstname']['value'] = $user->getFirstname();
      $admin_add_user_form['struct']['lastname']['value'] = $user->getLastname();
      $admin_add_user_form['struct']['user_status']['checked'] = $user->getStatus();
      $admin_add_user_form['struct']['user_rights']['checked'] = $user->getRights();

      $v->assign('admin_add_user_form', $admin_add_user_form);

      if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
          $v->assign('errors', $_SESSION['errors']);
          unset($_SESSION['errors']);
      }
    }

    /**
     * Action that allow an administrator to
     * manually delete a user
     * @return Void
     */
    public function deleteAction($user_id)
    {
        $user = new Users();
        $user_id = trim($user_id[0]);
        try {
            $user = $user->populate(['id' => $user_id]);
            $user->delete();
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/users');
    }

    /**
     * Action trigger the update un DB
     * @return Void
     */
    public function doUpdateAction($user_id)
    {
      $user = new Users();
      $user_id = trim($user_id[0]);
      $_SESSION['errors'] = [];

      try {
          $user = $user->populate(['id' => $user_id]);
      } catch (Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        $user->setEmail($_POST['user_email']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        $user->setFirstname($_POST['firstname']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        $user->setLastname($_POST['lastname']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        $user->setUsername($_POST['username']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

       try {
         $user->setRights(intval($_POST['user_rights']));
       } catch (\Exception $e) {
         array_push($_SESSION['errors'], $e->getMessage());
       }

       try {
         $user->setStatus(intval($_POST['user_status']));
       } catch (\Exception $e) {
         array_push($_SESSION['errors'], $e->getMessage());
       }

       try {
           $user->setUserImg($_FILES['user_img']);
       } catch (\Exception $e) {
         array_push($_SESSION['errors'], $e->getMessage());
       }

      try {
        if(empty($_SESSION['errors']))
             $user->save();
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      // If no error login and send him / her on the home page
      if(empty($_SESSION['errors']))
      {
         unset($_SESSION['errors']);
         header('Location: '.BASE_URL.'admin/users');
      } else {
         header('Location: '.BASE_URL.'admin/update/'.$user->getUsername());
      }
    }

    /**
     * Action trigger the add un DB
     * @return Void
     */
    public function doAddAction()
    {
      $user = new Users();
      $_SESSION['errors'] = [];

      $userExist = $user->userExist($_POST['username'], $_POST['user_email']);

      if (!empty($userExist)) {
         $_SESSION['errors'] = $userExist;
         header('Location: '.BASE_URL.'admin/users');
      }

      try {
        $user->setEmail($_POST['user_email']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        $user->setFirstname($_POST['firstname']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        $user->setLastname($_POST['lastname']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        $user->setUsername($_POST['username']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
        if($_POST['user_pwd'] === $_POST['user_pwd2'])
           $user->setPassword($_POST['user_pwd']);
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

       try {
         $user->setRights(intval($_POST['user_rights']));
       } catch (\Exception $e) {
         array_push($_SESSION['errors'], $e->getMessage());
       }

       try {
         $user->setStatus(intval($_POST['user_status']));
       } catch (\Exception $e) {
         array_push($_SESSION['errors'], $e->getMessage());
       }

       try {
           $user->setUserImg($_FILES['user_img']);
       } catch (\Exception $e) {
         array_push($_SESSION['errors'], $e->getMessage());
       }

      try {
        if(empty($_SESSION['errors']))
             $user->save();
      } catch (\Exception $e) {
        array_push($_SESSION['errors'], $e->getMessage());
      }

      // If no error login and send him / her on the home page
      if(empty($_SESSION['errors']))
      {
         unset($_SESSION['errors']);
         unset($_SESSION['addUSer']);
         header('Location: '.BASE_URL.'admin/users');
      } else {
        $_SESSION['addUSer']['user_email'] = $_POST['user_email'];
        $_SESSION['addUSer']['firstname'] = $_POST['firstname'];
        $_SESSION['addUSer']['lastname'] = $_POST['lastname'];
        $_SESSION['addUSer']['username'] = $_POST['username'];
        $_SESSION['addUSer']['user_status'] = $_POST['user_status'];
        $_SESSION['addUSer']['user_rights'] = $_POST['user_rights'];
        header('Location: '.BASE_URL.'admin/users/add');
      }
    }

  }
