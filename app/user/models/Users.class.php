<?php

  namespace App\User\Models;

  use Core\Database\Model;

  /**
   * Model Class who represent a user
   * in the database
   */
  class Users extends Model
  {
      protected $id; // The id in the database of the user
      protected $email; // The email in the database of the user
      protected $password; // The password in the database of the user
      protected $firstname; // The firstname in the database of the user
      protected $lastname; // The lastname in the database of the user
      protected $username; // The username in the database of the user
      // TODO protected $role_id; The role id in the database of the user
      protected $status; // The status in the database of the user


      /**
       * Constructor of the Users model class
       * @return Void
       */
      public function __construct($id=-1, $email=null, $password=null, $firstname=null,
      $username=null, $lastname=null, $permission=0, $status=0)
      {
          parent::__construct();

          $this->setId($id);
          $this->setEmail($email);
          $this->setPassword($password);
          $this->setFirstname($firstname);
          $this->setLastname($lastname);
          $this->setUsername($username);
          // TODO $this->setPermission($permission);
          $this->setStatus($status);
      }

      /**
       * Simple id getter
       * @return Integer : $id The id of the user
       */
      public function getId()
      {
          return $this->id;
      }

      /**
       * Simple Email setter
       * Check if the email respect the integrity of the database
       * @param String : $setEmail The email to be setted
       * @return Void
       */
      public function setEmail($setEmail)
      {
        if(gettype($setEmail) === 'string')
        {
          if (filter_var($setEmail, FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL))
          {
            $this->email = trim($setEmail);
          } else {
            Helpers::log("A not safe email have been tried to be inserted in the database ! ");
            die("Email not formed correctly !");
          }
        } else {
          Helpers::log("A not string variable for the email in ". get_class($this)
            ." have been tried to inserted in the database");
          die("Incorect email !");
        }
      }


      /**
       * Simple email getter
       * @return String $email The email
       */
      public function getEmail()
      {
          return $this->email;
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
          die("Not well formed password !");
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
            die("Too big Firstname !");
          }
        } else {
          Helpers::log("A not string variable for the firstname in ". get_class($this)
            ." have been tried to inserted in the database");
          die("Not well formed Firstname ! It should be inferior than 45 characters");
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
            die("Too big Lastname ! It should be inferior than 45 characters");
          }
        } else {
          Helpers::log("A not string variable for the lastname in ". get_class($this)
            ." have been tried to inserted in the database");
          die("Not well formed Lastname");
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
            die("Too big Username ! It should be inferior than 45 characters");
          }
        } else {
          Helpers::log("A not string variable for the username in ". get_class($this)
            ." have been tried to inserted in the database");
          die("not well formed Username !");
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
      * Check if the role_id respect the integrity of the database
      * @param Integer : $setRole_id The role_id to be setted
      * @return Void
      */
      public function setRole_id($setRole_id)
      {
        if(preg_match($setRole_id, "/^-?\d*/"))
        {
          $this->role_id = $setRole_id;
        } else {
          Helpers::log("A not integer variable for the role_id in ". get_class($this)
            ." have been tried to inserted in the database");
          die("Incorect role !");
        }
      }

      /**
       * Simple role_id getter
       * @return Integer : $role_id The role id
       */
      public function getRole_id()
      {
        return $this->role;
      }

       /**
       * Simple setter for the status
       * Check if the status respect the integrity of the database
       * @param Integer : $setStatus The status to be setted
       * @return Void
       */
      public function setStatus($setStatus)
      {
        if(preg_match($setStatus, "/^-?\d*/"))
        {
          $this->status = $setStatus;
        } else {
          Helpers::log("A not integer variable for the status in ". get_class($this)
            ." have been tried to inserted in the database");
          die("Incorect email !");
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

  }
