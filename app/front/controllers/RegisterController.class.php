<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use App\User\Models\Users;
  use Core\Util\Helpers;
  use Core\Facades\Query;
  use Core\Auth\DBAuth;


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
        parent::__construct();
    }

    /**
     * Index of the register page which consist of the
     * forms so a user can register in.
     * @return Void
     */
    public function indexAction()
    {
        $v = new View('register');

        
    }

    /**
     * This action register a user in the database
     * By cleaning the inputed data and use the good model
     * @return Void
     */
    public function registerAction()
    {
         $data = $_POST['data'] or $_REQUEST['data'];
         $cleanedData = array_map("Helpers::cleanString", json_decode($data));

         $user = new Users();
         $_POST['errors'] = NULL;

         try {
           $user->setEmail($cleanedData['email']);
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         try {
           $user->setPassword($cleanedData['password']);
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         try {
           $user->setFirstname($cleanedData['firstname']);
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         try {
           $user->setLastname($cleanedData['lastname']);
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         try {
           $user->setUsername($cleanedData['username']);
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         try {
           $user->setPermission(0);
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         try {
           $user->setStatus(0);
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         try {
           $user->save();
         } catch (\Exception $e) {
           array_push($_POST['errors'], $e->getMessage());
         }

         // If no error login and send him / her on the home page
         if($_POST['errors'] === NULL)
         {
            $auth = new DBAuth();
            $auth->login($cleanedData['username'], $cleanedData['password']);
            header('Location: '.BASE_URL);
         } else {
            $_POST['data'] = $cleanedData;
            header('Location: '.BASE_URL.'front/register');
         }

    }

  }
