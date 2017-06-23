<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use Core\Facades\Auth;
  use Core\Facades\Query;
  use Core\Route\Routing;
  use Core\HTML\Modals;
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
          $_SESSION['login']['error'] = "The User doesn't exist";
          header('Location: '.BASE_URL.'login');
      } elseif ($auth_user === 1) {
          $_SESSION['login']['username'] = $_POST['username'];
          $_SESSION['login']['error'] = 'Username or password invalid';
          header('Location: '.BASE_URL.'login');
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
