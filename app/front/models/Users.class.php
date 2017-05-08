<?php

  namespace App\Front\Models;

  use Core\Util\Helpers;
  use App\Composite\Models\User;

  /**
   * Model Class who represent a user
   * in the database
   */
   class Users extends User
   {

     public function __construct($id=-1, $email=null, $password=null, $firstname=null,
     $username=null, $lastname=null, $permission=0, $status=0)
     {
         parent::__construct($id, $email, $password, $firstname, $username, $lastname,
           $permission, $status);

     }

     /**
      * Function to check if an username already exist for an user in the database
      * @param String : $username The username to be checked
      * @param String : $email The email to be checked
      * @return String : $error return the error, False instead
      */
     protected function usernameExist($username)
     {
       $query = $this->qb->select('username')
               ->from($this->getTable())
               ->where('username=:username');


       $preparedQuery = [':username' => $username];
       $result = $this->qb->prepare($query, $preparedQuery, null, true);

       if(empty($result)) {
         return False;
       } else {
         return 'This username is already taken';
       }
     }

     /**
      * Function to check if an user already exist in the database
      * Basically a wrapper around usernameExist and emailExist
      * @param String : $username The username to be checked
      * @param String : $email The email to be checked
      * @return Array : $errors Return of errors, False instead
      */
     public function userExist($username, $email)
     {
       $errors = [];
       array_push($errors, $this->usernameExist($username));
       array_push($errors,$this->emailExist($email));
       return $errors;
     }


   }
