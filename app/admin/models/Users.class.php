<?php

  namespace App\Admin\Models;

  use Core\Util\Helpers;
  use App\Composite\Models\User;
  use App\Composite\Traits\Models\GetAllDataTrait;

  /**
   * Model Class who represent a user
   * in the database
   */
  class Users extends User
  {

    use GetAllDataTrait;


    public function __construct($id=-1, $email=null, $password=null, $firstname=null,
    $username=null, $lastname=null, $permission=0, $status=0)
    {
        parent::__construct($id, $email, $password, $firstname, $username, $lastname,
          $permission, $status);

    }

  }
