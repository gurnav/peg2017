<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Facades\Auth;
  use Core\HTML\Modals;
  use Core\Route\Routing;
  use Core\Email\Email;
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

        $user_form = ModalsFactory::registerUserForm();
        if(!empty($_SESSION['register'])) {
          $user_form['struct']['user_email']['value'] = $_SESSION['register']['user_email'];
          $user_form['struct']['user_newsletters']['checked'] = $_SESSION['register']['user_newsletters'];
          $user_form['struct']['username']['value'] = $_SESSION['register']['username'];
          $user_form['struct']['firstname']['value'] = $_SESSION['register']['firstname'];
          $user_form['struct']['lastname']['value'] = $_SESSION['register']['lastname'];
        }

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
           if($_POST['user_pwd'] === $_POST['user_pwd2']) {
               $user->setPassword($_POST['user_pwd']);
           } else {
               array_push($_SESSION['errors'], "Passwords does not match.");
           }
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
           $user->setNewsletters(intval($_POST['user_newsletters']));
         } catch (\Exception $e) {
           array_push($_SESSION['errors'], $e->getMessage());
         }

          try {
            $user->setRights(1);
          } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
          }

         try {
           $user->setStatus(0);
         } catch (\Exception $e) {
           array_push($_SESSION['errors'], $e->getMessage());
         }

         try {
             if($_FILES['user_img']['size'] == 0) {
                 $user->setUserImg(null);
             } else {
                 $user->setUserImg($_FILES['user_img']);
             }
         } catch (\Exception $e) {
           array_push($_SESSION['errors'], $e->getMessage());
         }

         try {
           if(empty($_SESSION['errors']))
                $user->save();
         } catch (\Exception $e) {
           array_push($_SESSION['errors'], $e->getMessage());
         }

         if(empty($_SESSION['errors']))
         {
             unset($_SESSION['register']);
             $_SESSION['msg'] = 'You have been registered. Please confirm your inscription by clicking on the link in the sent mail';

             $encryptedEmail = openssl_encrypt($user->getEmail(), "aes-256-cbc", "esgi-geographic", 0, "AzErTyUiOp123456789");

             $mail = new Email();
             $mail->setAddressee($user->getEmail());
             $mail->setSubject("Registering at ".SITE_NAME.".");
             $mail->setMessage(
             "You have been registered to ".SITE_NAME."."."<br>"
             ."\nPlease click on this link to verify and activate your account :"
             .BASE_URL."verification/email/".$encryptedEmail."<br>"
             ."Cheers,"."<br>"
             ." The team of ".SITE_NAME);
             try {
                 $mail->sendMail();
             } catch (\Exception $e) {
                 $_SESSION['msg'] = 'An error has occured with the mail sending.
                 Please contact the site admnistrator to activate your account with the email you used to subscribe with.';
             }

            Routing::index();
         } else {
            $_SESSION['register']['user_email'] = $_POST['user_email'];
            $_SESSION['register']['user_newsletters'] = $_POST['user_newsletters'];
            $_SESSION['register']['firstname'] = $_POST['firstname'];
            $_SESSION['register']['lastname'] = $_POST['lastname'];
            $_SESSION['register']['username'] = $_POST['username'];
            header('Location: '.BASE_URL.'register');
         }

    }

  }
