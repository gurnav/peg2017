<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Helpers\Traits\Models\UsersIdTrait;
  use App\Helpers\Traits\Models\IdTrait;
  use App\Helpers\Traits\Models\GetAllDataTrait;

  /**
   * Contents Model who reprensent the Roles table
   * in the database
   */
  class Roles extends Model
  {
    use UsersIdTrait;
    use IdTrait;
    use GetAllDataTrait;

    protected $id;
    protected $name;
    protected $rights;
    protected $users_id;

    /**
     * Constructor of the Roles model class
     * @return Void
     */
    public function __construct($id=-1, $name=null, $rights=null, $users_id=-1)
    {
      parent::__construct();

      $this->setId($id);
      $this->setName($name);
      $this->setRights($rights);
      $this->setUsers_id($users_id);
    }

    /**
     * Simple name getter
     * @return Int $name the name of the role
     */
    public function getName()
    {
      return $this->name;
    }

    /**
     * Simple setter for the name
     * Check if the title respect the integrity of the database
     * So if that a string and lesser than 60 characters
     * @param String : $name The name to be set
     * @return Void
     */
    public function setName($name)
    {
      if(gettype($name) === 'string')
      {
        if(strlen($name) <= 60)
        {
          $this->name = trim($name);
        } else {
          Helpers::log("A word count superior to 60 has tried to be created in a new role name");
          die("You can't enter a role name with a words count superior to 60");
        }
      } else {
        Helpers::log("A non string type has been entered as title in content n° : " . $this->getId());
        die("You can't enter a number as a title !");
        }
      }

      // TODO
      public function getRights() {}
      public function setRights($rights) {}

  }
