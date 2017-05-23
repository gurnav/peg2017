<?php

  namespace App\Composite\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\EmailTrait;

  /**
   * Model Class who represent a user
   * in the database
   */
  class User extends Model
  {
    use IdTrait;
    use EmailTrait;

      protected $id; // The id in the database of the user
      protected $email; // The email in the database of the user
      protected $password; // The password in the database of the user
      protected $firstname; // The firstname in the database of the user
      protected $lastname; // The lastname in the database of the user
      protected $username; // The username in the database of the user
      protected $rights; // The rights of the user
      protected $status; // The status in the database of the user


      /**
       * Constructor of the User model class
       * @return Void
       */
      public function __construct($id=-1, $email=null, $password=null, $firstname=null,
      $username=null, $lastname=null, $rights = 1, $status=0)
      {
          parent::__construct();

          if($id === -1) {
            $this->id = $id;
          } else {
            $this->setId($id);
          }

          if($email === null) {
            $this->email = $email;
          } else {
            $this->setEmail($email);
          }

          if($password === null) {
            $this->password = $password;
          } else {
            $this->setPassword($password);
          }

          if($firstname === null) {
            $this->firstname = $firstname;
          } else {
            $this->setFirstname($firstname);
          }

          if($lastname === null) {
            $this->lastname = $lastname;
          } else {
            $this->setLastname($lastname);
          }

          if($username === null) {
            $this->username = $username;
          } else {
            $this->setUsername($username);
          }

          if($rights === 1) {
             $this->rights = $rights;
          } else {
             $this->setRights($rights);
          }

          if($status === 0) {
            $this->status = $status;
          } else {
            $this->setStatus($status);
          }

      }

      /**
      * Simple setter for the password with bluecrypt encryption
      * Check if the password respect the integrity of the database
      * @param String : $setPassword The password to be crypted and setted
      * @return Void
      */
      public function setPassword($setPassword)
      {
        if(gettype($setPassword) === 'string')
        {
          $this->password = password_hash($setPassword, PASSWORD_DEFAULT);
        } else {
          Helpers::log("A not string variable for the password in ". get_class($this)
            ." have been tried to inserted in the database");
          throw new \Exception("Not well formed password !");
        }
      }

      /**
       * Simple password getter
       * @return String $password The password
       */
      public function getPassword()
      {
          return $this->password;
      }

      /**
      * Simple setter for the firstname with trim
      * Check if the firstname respect the integrity of the database
      * @param String : $setFirstname The firstname to be setted
      * @return Void
      */
      public function setFirstname($setFirstname)
      {
        if(gettype($setFirstname) === 'string')
        {
          if(strlen($setFirstname) <= 45)
          {
            $this->firstname = trim($setFirstname);
          } else {
            Helpers::log("A string bigger than 45 char for the firstname in ". get_class($this)
              ." have been tried to inserted in the database");
            throw new \Exception("Too big Firstname !");
          }
        } else {
          Helpers::log("A not string variable for the firstname in ". get_class($this)
            ." have been tried to inserted in the database");
          throw new \Exception("Not well formed Firstname ! It should be inferior than 45 characters");
        }
      }

      /**
       * Simple firstname getter
       * @return String $firstname The firstname
       */
      public function getFirstname()
      {
          return $this->firstname;
      }

      /**
      * Simple setter for the lastname with trim
      * Check if the lastname respect the integrity of the database
      * @param String : $setLastname The lastname to be setted
      * @return Void
      */
      public function setLastname($setLastname)
      {
        if(gettype($setLastname) === 'string')
        {
          if(strlen($setLastname) <= 45)
          {
            $this->lastname = trim($setLastname);
          } else {
            Helpers::log("A string bigger than 45 char for the lastname in ". get_class($this)
              ." have been tried to inserted in the database");
            throw new \Exception("Too big Lastname ! It should be inferior than 45 characters");
          }
        } else {
          Helpers::log("A not string variable for the lastname in ". get_class($this)
            ." have been tried to inserted in the database");
          throw new \Exception("Not well formed Lastname");
        }
      }

      /**
       * Simple lastname getter
       * @return String $lastname The lastname
       */
      public function getLastname()
      {
          return $this->lastname;
      }

      /**
      * Simple setter for the username with trim
      * Check if the username respect the integrity of the database
      * @param String : $setUsername The username to be setted
      * @return Void
      */
      public function setUsername($setUsername)
      {
        if(gettype($setUsername) === 'string')
        {
          if(strlen($setUsername) <= 45)
          {
            $this->username = trim($setUsername);
          } else {
            Helpers::log("A string bigger than 45 char for the username in ". get_class($this)
              ." have been tried to inserted in the database");
            throw new \Exception("Too big Username ! It should be inferior than 45 characters");
          }
        } else {
          Helpers::log("A not string variable for the username in ". get_class($this)
            ." have been tried to inserted in the database");
          throw new \Exception("not well formed Username !");
        }
      }

      /**
       * Simple username getter
       * @return String $username The username
       */
      public function getUsername()
      {
          return $this->username;
      }

      /**
      * Simple setter for the username with trim
      * Check if the rights respect the integrity of the database
      * @param Integer : $rights The rights to be setted
      * @return Void
      */
      public function setRights($rights)
      {
        if(is_int($rights))
        {
          $this->rights = $rights;
        } else {
          Helpers::log("A not integer variable for the rights in ". get_class($this)
            ." have been tried to inserted in the database");
          throw new \Exception("Incorect rights !");
        }
      }

      /**
       * Simple rights getter
       * @return Integer : $rights The rights as int
       */
      public function getRights()
      {
        return $this->rights;
      }

       /**
       * Simple setter for the status
       * Check if the status respect the integrity of the database
       * @param Integer : $setStatus The status to be setted
       * @return Void
       */
      public function setStatus($setStatus)
      {
        if(is_int($setStatus))
        {
          $this->status = $setStatus;
        } else {
          Helpers::log("A non integer variable for the status in ". get_class($this)
            ." have been tried to inserted in the database");
          throw new \Exception("Incorect status !");
        }
      }

      /**
       * Simple status getter
       * @return String $status The status
       */
      public function getStatus()
      {
          return $this->status;
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
          return True;
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
        if($this->usernameExist($username)) {
          array_push($errors, 'This username is already taken');
        }
        if($this->emailExist($email)) {
          array_push($errors, 'This email is already taken');
        }
        return $errors;
      }

      public static function getIdByUsername($type) {
          if ($type === "admin") {
              $username = $_SESSION["admin"];
          }

          elseif ($type === "author") {
              $username = $_SESSION["author"];
          }

          elseif ($type === "user"){
              $username = $_SESSION["user"];
          }

          else{
              Helpers::log("Unrecognised user session rights. Not defined.");
              throw new \Exception("Unrecognised user session rights. Not defined.");
          }

          return $username;
      }

  }
