<?php

  namespace App\Admin\Models;

  use Core\Util\Helpers;
  use App\Composite\Models\User;
  use App\Composite\Traits\Models\GetAllDataTrait;
  use Core\Database\QueryBuilder;

  /**
   * Model Class who represent a user
   * in the database
   */
  class Users extends User
  {

    use GetAllDataTrait;


    public function __construct($id=-1, $email=null, $password=null, $firstname=null,
    $username=null, $lastname=null, $newsletters = 0, $permission=0, $status=0)
    {
        parent::__construct($id, $email, $password, $firstname, $username, $lastname,
          $newsletters, $permission, $status);

    }

    /**
     * Get all subscribed users
     * @return $users : Object a list of subscribed users
     */
    public static function getAllNewslettersUsers()
    {
        $qb = new QueryBuilder();

        $query = $qb->select('*')
            ->from(DB_PREFIX.'users')
            ->where('status = 1')
            ->where('newsletters = 1')
            ->where('deleted = 0');

        return $qb->query($query);
    }

  }
