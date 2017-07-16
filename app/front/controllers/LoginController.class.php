<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use Core\Facades\Auth;
  use Core\Facades\Query;
  use Core\Route\Routing;
  use Core\HTML\Modals;
  use Core\Email\Email;
  use App\Front\Models\Users;
  use App\Composite\Factories\ModalsFactory;


  /**
   * Class for registering a user
   */
  class LoginController extends Controller
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
        $v = new View('users/login');

        $user_form = ModalsFactory::loginUserForm();
        if(!empty($_SESSION['login']['username'])) {
            $user_form_factory['struct']['username']['value'] = $_SESSION['login']['username'];
        }

        if(!empty($_SESSION['login']['error'])) {
            $v->assign('error', $_SESSION['login']['error']);
        }

        $v->assign('user_form', $user_form);
        unset($_SESSION['login']);
    }

    /**
     * This action register a user in the database
     * By cleaning the inputed data and use the good model
     * @return Void
     */
    public function loginAction()
    {

        $auth_user = Auth::login($_POST['username'], $_POST['user_pwd']);

        if ($auth_user === 0)
        {
          // $user = new Users();
          // $user->populate(['username' => $_POST['username']]);
          unset($_SESSION['login']);
          Routing::index();
      } elseif ($auth_user === -1) {
          $_SESSION['login']['error'] = "The User doesn't exist or is not validated yet.";
          header('Location: '.BASE_URL.'login');
      } elseif ($auth_user === 1) {
          $_SESSION['login']['username'] = $_POST['username'];
          $_SESSION['login']['error'] = 'Username or password invalid';
          header('Location: '.BASE_URL.'login');
      }

    }


    /**
     * Action which allow an user to have a new passwords by giving his mail
     * @return void
     */
    public function forgot_passwordAction()
    {
        $v = new View('users/forgot_password');
        $fp_form = ModalsFactory::forgotPasswordForm();

        if(!empty($_SESSION['errors'])) {
            $v->assign('error', $_SESSION['errors']);
        }

        $v->assign('fp_form', $fp_form);
    }

    /**
     * Action which send a new passord to a user
     * @return void
     */
    public function send_new_passwordAction()
    {
        $email = $_POST['user_email'];

        $user = new Users();
        $user = $user->populate(['email' => $email]);

        if ($user->getId() != -1) {

            try {
                $pwd = str_shuffle('AzErTyUiOp123456');
                $user->setPassword($pwd);
                $user->save();
            } catch (\Exception $e) {
                array_push($_SESSION['errors'], $e->getMessage());
            }

            if (empty($_SESSION['errors'])) {

                $_SESSION['msg'] = 'Your new password have been sent to your email';

                $mail = new Email();
                $mail->setAddressee($email);
                $mail->setSubject("New Email on : ".SITE_NAME);
                $mail->setMessage(
                "Here is your new password on : ".SITE_NAME."<br>"
                ."New password : ".$pwd."<br>"
                ."Cheers,<br>"
                ."The team of ".SITE_NAME);
                try {
                    $mail->sendMail();
                } catch (\Exception $e) {
                    $_SESSION['msg'] = 'An error has occured whit the mail sending.
                    Please contact the site admnistrator to setup a new password account or retry later.';
                }

                Routing::index();
            }
        }
    }


    /**
     * Logout the actual user
     * @return Void
     */
    public function logoutAction()
    {
          Auth::disconnect();
          Routing::index();
    }

  }
