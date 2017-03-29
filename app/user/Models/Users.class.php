<?php

  namespace App\User\Models;

  use Core\Database\Model;

  class Users extends Model
  {
      protected $id;
      protected $email;
      protected $password;
      protected $firstname;
      protected $lastname;
      protected $username;
      // protected $role;
      protected $status;


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
          // $this->setPermission($permission);
          $this->setStatus($status);
      }

      public function setId($setId)
      {
          $this->id = $setId;
      }

      public function getId()
      {
          return $this->id;
      }

      public function setEmail($setEmail)
      {
          if (filter_var($setEmail, FILTER_VALIDATE_EMAIL)) {
              $this->email = trim($setEmail);
          }
      }

      public function getEmail()
      {
          return $this->email;
      }

      public function setPassword($setPassword)
      {
          $this->password = password_hash($setPassword, PASSWORD_DEFAULT);
      }

      public function getPassword()
      {
          return $this->password;
      }

      public function setFirstname($setFirstname)
      {
          $this->firstname = trim($setFirstname);
      }

      public function getFirstname()
      {
          return $this->firstname;
      }

      public function setLastname($setLastname)
      {
          $this->lastname = trim($setLastname);
      }

      public function getLastname()
      {
          return $this->lastname;
      }

      public function setUsername($setUsername)
      {
          $this->username = trim($setUsername);
      }

      public function getUsername()
      {
          return $this->username;
      }

    /**
     * TODO
     * public function setRole($setRole) {
     * $this->role = $setRole;
     * }
     *
     * public function getRole() {
     *  return $this->role;
     * }
     */

    public function setStatus($setStatus)
    {
        $this->status = $setStatus;
    }

    public function getStatus()
    {
        return $this->status;
    }

  }
