<?php

  namespace App\Models;
  use Core\Database\BaseSql;

  class Users extends BaseSql {

    protected $id;
    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $nickname;
    // protected $role;
    protected $status;


    public function __construct($id=-1, $email=null, $password=null, $firstname=null,
      $nickname=null, $lastname=null, $permission=0, $status=0) {

        parent::__construct();

        $this->setId($id);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setNickname($nickname);
        // $this->setPermission($permission);
        $this->setStatus($status);

    }

    public function setId($setId) {
      $this->id = $setId;
    }

    public function getId() {
      return $this->id;
    }

    public function setEmail($setEmail) {
      if( filter_var($setEmail, FILTER_VALIDATE_EMAIL)  ){
  			$this->email = trim($setEmail);
  		}
    }

    public function getEmail() {
      return $this->email;
    }

    public function setPassword($setPassword) {
      $this->password = password_hash($setPassword, PASSWORD_DEFAULT);
    }

    public function getPassword() {
      return $this->password;
    }

    public function setFirstname($setFirstname) {
      $this->firstname = trim($setFirstname);
    }

    public function getFirstname() {
      return $this->firstname;
    }

    public function setLastname($setLastname) {
      $this->lastname = trim($setLastname);
    }

    public function getLastname() {
      return $this->lastname;
    }

    public function setNickname($setNickname) {
      $this->nickname = trim($setNickname);
    }

    public function getNickname() {
      return $this->nickname;
    }

    /* TODO
    public function setRole($setRole) {
      $this->role = $setRole;
    }

    public function getRole() {
      return $this->role;
    }
    */

    public function setStatus($setStatus) {
      $this->status = $setStatus;
    }

    public function getStatus() {
      return $this->status;
    }

  }
