<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Util\Helpers;
  use Core\Views\View;
  use App\Front\Models\Users;

  /**
   * Class for managing user related action in front end
   */
  class ProfileController extends Controller
  {

      public function indexAction()
      {
          $user = new Users();
          $user = $user->populate(['id' => $_SESSION['user']['id']]);

          Helpers::debugVar($user);
          die();
      }

      /**
       * Function who allow a user to modify his profile
       * @return Void
       */
      public function editAction()
      {
          $user = new Users();
          $v = new View("users/profile");

          $user = $user->populate(['id' => $_SESSION['user']['id']]);
          $v->assign('user', $user);

          if (isset($_SESSION['errors'])) {
              $v->assign('errors', $_SESSION['errors']);
              unset($_SESSION['errors']);
          }

      }

      /**
       * Function for changing the Username
       * @return Void
       */
      public function changeUsernameAction()
      {
          $user = new Users();
          $user = $user->populate(['id' => $_SESSION['user']['id']]);

          try {
            $user->setUsername($_POST['username']);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
            $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile');
          } else {
              header('Location: '.BASE_URL.'profile/edit');
          }
      }

      /**
       * Function for changing the Firstname
       * @return Void
       */
      public function changeFirstnameAction()
      {
          $user = new Users();
          $user = $user->populate(['id' => $_SESSION['user']['id']]);

          try {
            $user->setFirstname($_POST['firstname']);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
            $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile');
          } else {
              header('Location: '.BASE_URL.'profile/edit');
          }
      }

      /**
       * Function for changing the lastname
       * @return Void
       */
      public function changeLastnameAction()
      {
          $user = new Users();
          $user = $user->populate(['id' => $_SESSION['user']['id']]);

          try {
            $user->setLastname($_POST['lastname']);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
            $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile');
          } else {
              header('Location: '.BASE_URL.'profile/edit');
          }

      }

      /**
       * Function for changing the email
       * @return Void
       */
      public function changeEmailAction()
      {
          $user = new Users();
          $user = $user->populate(['id' => $_SESSION['user']['id']]);

          try {
            $user->setEmail($_POST['email']);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
            $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile');
          } else {
              header('Location: '.BASE_URL.'profile/edit');
          }

      }

      /**
       * Function for changing the password
       * @return Void
       */
      public function changePasswordAction()
      {
          $user = new Users();
          $user = $user->populate(['id' => $_SESSION['user']['id']]);

          if ($_POST['password'] === $_POST['password_conf']) {
              if (password_verify($_POST['password'], $user->password)) {
                  try {
                      $user->setPassword($_POST['new_password']);
                  } catch (\Exception $e) {
                      array_push($_SESSION['errors'], $e->getMessage());
                  }
              } else {
                  array_push($_SESSION['errors'], "Password incorect");
              }
          } else {
              array_push($_SESSION['errors'], "Password and password confirmation does not match");
          }

          try {
            $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile');
          } else {
              header('Location: '.BASE_URL.'profile/edit');
          }
      }

      /**
       * Function that allow an user to change his image
       * @return Void
       */
       public function changeImgAction()
       {
           $user = new Users();
           $user = $user->populate(['id' => $_SESSION['user']['id']]);

           try {
               unlink(UPLOADS_DIR_USERS.$user->getUserImg());
               $user->setUserImg($_FILES['user_img']);
           } catch (\Exception $e) {
             array_push($_SESSION['errors'], $e->getMessage());
           }

           try {
             $user->save();
           } catch (\Exception $e) {
             array_push($_SESSION['errors'], $e->getMessage());
           }

           if (!isset($_SESSION['errors'])) {
               header('Location: '.BASE_URL.'profile');
           } else {
               header('Location: '.BASE_URL.'profile/edit');
           }
       }

  }
