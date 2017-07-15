<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Util\Helpers;
  use Core\Views\View;
  use Core\Auth\DBAuth;
  use Core\Route\Routing;
  use App\Front\Models\Users;

  /**
   * Class for managing user related action in front end
   */
  class ProfileController extends Controller
  {

      /**
       * Action for showing the profile of the user
       * @return Void
       */
      public function showAction($username)
      {
          $username = $username[0];

          $v = new View('users/profile');
          $user = new Users();

          $user = $user->populate(['username' => $username]);
          $v->assign('user', $user);
      }


      /**
       * Function who allow a user to modify his profile
       * @return Void
       */
      public function editAction($username)
      {
          $username = $username[0];

          if (DBAuth::isLogged())
          {
              if ($username === $_SESSION['user']['username'])
              {
                  $user = new Users();
                  $v = new View("users/edit_profile");

                  $user = $user->populate(['id' => $_SESSION['user']['id']]);
                  $v->assign('user', $user);

                  if (isset($_SESSION['errors'])) {
                      $v->assign('errors', $_SESSION['errors']);
                      unset($_SESSION['errors']);
                  }
              } else {
                  Routing::forbidden();
              }
          } else {
              Routing::forbidden();
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
            if (!isset($_SESSION['errors'])) $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile/show/'.$_SESSION['user']['username']);
          } else {
              header('Location: '.BASE_URL.'profile/edit'.$_SESSION['user']['username']);
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
            if (!isset($_SESSION['errors'])) $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile/show/'.$_SESSION['user']['username']);
          } else {
              header('Location: '.BASE_URL.'profile/edit'.$_SESSION['user']['username']);
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
            if (!isset($_SESSION['errors'])) $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile/show/'.$_SESSION['user']['username']);
          } else {
              header('Location: '.BASE_URL.'profile/edit'.$_SESSION['user']['username']);
          }
      }

      /**
       * Function for changing the subscrib status of a user
       * to the newsletters
       * @return Void
       */
      public function changeNewslettersAction()
      {
          $user = new Users();
          $user = $user->populate(['id' => $_SESSION['user']['id']]);

          try {
            $user->setNewsletters(intval($_POST['user_newsletters']));
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
            if (!isset($_SESSION['errors'])) $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile/show/'.$_SESSION['user']['username']);
          } else {
              header('Location: '.BASE_URL.'profile/edit'.$_SESSION['user']['username']);
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
              if (!isset($_SESSION['errors'])) $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile/show/'.$_SESSION['user']['username']);
          } else {
              header('Location: '.BASE_URL.'profile/edit'.$_SESSION['user']['username']);
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
              if (!isset($_SESSION['errors'])) $user->save();
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

          if (!isset($_SESSION['errors'])) {
              header('Location: '.BASE_URL.'profile/show/'.$_SESSION['user']['username']);
          } else {
              header('Location: '.BASE_URL.'profile/edit'.$_SESSION['user']['username']);
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
               if ($user->getUserImg() !== BASE_AVATAR) {
                   unlink(UPLOADS_DIR_USERS.$user->getUserImg());
               }
               $user->setUserImg($_FILES['user_img']);
               } catch (\Exception $e) {
                   array_push($_SESSION['errors'], $e->getMessage());
               }

           try {
               if (!isset($_SESSION['errors'])) $user->save();
           } catch (\Exception $e) {
             array_push($_SESSION['errors'], $e->getMessage());
           }

           if (!isset($_SESSION['errors'])) {
               header('Location: '.BASE_URL.'profile/show/'.$_SESSION['user']['username']);
           } else {
               header('Location: '.BASE_URL.'profile/edit'.$_SESSION['user']['username']);
           }
       }


  }
