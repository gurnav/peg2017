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
        $v = new View('users/add_user');
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
    public function updateAction($username)
    {
        $v = new View('users/add_user');
        $user = new Users();
        $username = $username[0];
        $user = $user->populate(['username' => $username]);
        $admin_add_user_form = ModalsFactory::adminUpdateUserForm($username);
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
    public function deleteAction($username)
    {
        $user = new Users();
        $username = trim($username[0]);
        try {
            $user = $user->populate(['username' => $username]);
            $user->delete();
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/users');
    }
    public function doUpdateAction($username)
    {
        $user = new Users();
        $username = trim($username[0]);
        $_SESSION['errors'] = [];
        foreach ($_POST as $post => $value) {
            $cleanedData[$post] = Helpers::cleanString($value);
        }
        try {
            $user = $user->populate(['username' => $username]);
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setEmail($cleanedData['user_email']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setFirstname($cleanedData['firstname']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setLastname($cleanedData['lastname']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setUsername($cleanedData['username']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setRights(intval($cleanedData['user_rights']));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setStatus(intval($cleanedData['user_status']));
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
    public function doAddAction()
    {
        $user = new Users();
        $_SESSION['errors'] = [];
        foreach ($_POST as $post => $value) {
            $cleanedData[$post] = Helpers::cleanString($value);
        }
        $userExist = $user->userExist($cleanedData['username'], $cleanedData['user_email']);
        if (!empty($userExist)) {
            $_SESSION['errors'] = $userExist;
            header('Location: '.BASE_URL.'admin/users');
        }
        try {
            $user->setEmail($cleanedData['user_email']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setFirstname($cleanedData['firstname']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setLastname($cleanedData['lastname']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setUsername($cleanedData['username']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            if($cleanedData['user_pwd'] === $cleanedData['user_pwd2'])
                $user->setPassword($cleanedData['user_pwd']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setRights(intval($cleanedData['user_rights']));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $user->setStatus(intval($cleanedData['user_status']));
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
            $_SESSION['addUSer']['user_email'] = $cleanedData['user_email'];
            $_SESSION['addUSer']['firstname'] = $cleanedData['firstname'];
            $_SESSION['addUSer']['lastname'] = $cleanedData['lastname'];
            $_SESSION['addUSer']['username'] = $cleanedData['username'];
            $_SESSION['addUSer']['user_status'] = $cleanedData['user_status'];
            $_SESSION['addUSer']['user_rights'] = $cleanedData['user_rights'];
            header('Location: '.BASE_URL.'admin/users/add');
        }
    }
}