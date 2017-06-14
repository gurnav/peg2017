<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Facades\Auth;
  use Core\HTML\Modals;
  use Core\Route\Routing;
  use App\Front\Models\Users;
  use App\Composite\Factories\ModalsFactory;


  /**
   * Class for registering a user
   */
  class RegisterController extends Controller
  {

    /**
     * Constructor of the User Register Controller class
     * @return Void
     */
    public function __construct()
    {
        // parent::__construct();

    }

    /**
     * Index of the register page which consist of the
     * forms so a user can register in.
     * @return Void
     */
    public function indexAction()
    {
        $v = new View('users/register');

        $user_form_factory = ModalsFactory::registerUserForm();
        if(!empty($_SESSION['register'])) {
          $user_form_factory['struct']['user_email']['value'] = $_SESSION['register']['user_email'];
          $user_form_factory['struct']['username']['value'] = $_SESSION['register']['username'];
          $user_form_factory['struct']['firstname']['value'] = $_SESSION['register']['firstname'];
          $user_form_factory['struct']['lastname']['value'] = $_SESSION['register']['lastname'];
        }

        $user_form = Modals::generateForm($user_form_factory);

        if(!empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
        }

        $v->assign('user_form', $user_form);
        unset($_SESSION['register']);
        unset($_SESSION['errors']);
    }

    /**
     * This action register a user in the database
     * By cleaning the inputed data and use the good model
     * @return Void
     */
    public function registerAction()
    {

         $user = new Users();
         $_SESSION['errors'] = [];

         $userExist = $user->userExist($_POST['username'], $_POST['user_email']);

         if (!empty($userExist)) {
            $_SESSION['errors'] = $userExist;
            header('Location: '.BASE_URL.'register');
         }

         try {
           $user->setEmail($_POST['user_email']);
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
            $user->setRole_id(1);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }


         try {
           $user->setStatus(0);
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
            Auth::login($_POST['username'], $_POST['user_pwd']);
            unset($_SESSION['register']);
            Routing::index();
         } else {
            $_SESSION['register']['user_email'] = $_POST['user_email'];
            $_SESSION['register']['firstname'] = $_POST['firstname'];
            $_SESSION['register']['lastname'] = $_POST['lastname'];
            $_SESSION['register']['username'] = $_POST['username'];
            header('Location: '.BASE_URL.'register');
         }

    }

  }
