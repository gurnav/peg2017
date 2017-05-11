<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Database\Models;
  use App\Admin\Models\Users;
  use App\Composite\Factories\ModalsFactory;

  class UsersController extends Controller
  {

    public function indexAction()
    {
      $v = new View('users/users');
      $users = Users::getAll();

      $v->assign('users', $users);

      if(!empty($SESSION['errors'])) {
        $v->assign('errors', $errors);
        unset($_SESSION['errors']);
      }

    }

    public function addAction()
    {

    }

    public function updateAction($user)
    {
      $v = new View('users/add_user');

      $u_user = new Users();
      $username = $user[0];
      $u_user = $u_user->populate(['username' => $username]);

      $admin_add_user_form = ModalsFactory::adminAddUserForm($username);

      $v->assign('u_user', $u_user);
      $v->assign('admin_add_user_form', $admin_add_user_form);
    }

    public function deleteAction($user)
    {
        $d_user = new Users();
        $username = trim($user[0]);
        try {
            $d_user = $d_user->populate(['username' => $username]);
            $d_user->delete();
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/users');
    }

    private function doUpdateAction($user)
    {
      $u_user = new Users();
      $u_user->populate(['username' => $user[0]]);
      try {
          $u_user->populate(['username' => $user[0]]);
          Helpers::debugVar($u_user);
      } catch (Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }
    }

  }
