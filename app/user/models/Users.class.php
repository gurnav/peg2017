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
       * Email setter
       * Check if the email respect the integrity of the database
       * @param String : $setEmail The email to be setted
       * @return Void
       */
      public function setEmail($setEmail)
      {
          if (filter_var($setEmail, FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL)) {
              $this->email = trim($setEmail);
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

      public function setPassword($setPassword)
      {
          $this->password = password_hash($setPassword, PASSWORD_DEFAULT);
      }

      /**
       * Simple password getter
       * @return String $password The password
       */
      public function getPassword()
      {
          return $this->password;
      }

      public function setFirstname($setFirstname)
      {
          $this->firstname = Helpers::cleanString(trim($setFirstname));
      }

      /**
       * Simple firstname getter
       * @return String $firstname The firstname
       */
      public function getFirstname()
      {
          return $this->firstname;
      }

      public function setLastname($setLastname)
      {
          $this->lastname = Helpers::cleanString(trim($setLastname));
      }

      /**
       * Simple lastname getter
       * @return String $lastname The lastname
       */
      public function getLastname()
      {
          return $this->lastname;
      }

      public function setUsername($setUsername)
      {
          $this->username = Helpers::cleanString(trim($setUsername));
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
       * TODO
       * public function setRole_id($setRole_id) {
       * $this->role_id = $setRole_id;
       * }
       *
       * public function getRole_id() {
       *  return $this->role;
       * }
       */

      public function setStatus($setStatus)
      {
          $this->status = $setStatus;
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
