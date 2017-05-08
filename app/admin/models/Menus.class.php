<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\GetAllDataTrait;

  class Menus extends Model
  {

    use UsersIdTrait;
    use IdTrait;
    use GetAllDataTrait;

    protected $id;
    protected $name;
    protected $contents_id;
    protected $users_id;

    /**
     * Constructor of the Menus model class
     * @return Void
     */
    public function __construct($id=-1, $name=null, $contents_id=1,$users_id=-1)
    {
        parent::__construct();
        $this->setId($id);
        $this->setName($name);
        $this->setContents_id($contents_id);
        $this->setUsers_id($users_id);
    }

    /**
       * Simple setter for the name
       * Check if the name respect the integrity of the database
       * So if that a string and lesser than 128
       * @param String : $name The Name to be set
       * @return Void
       */
      public function setName($name)
      {
          if(is_string($name))
          {
              if(strlen($name) <= 128)
              {
                  $this->name = trim($name);
              } else {
                  Helpers::log("A string bigger than 128 char for the name in ". get_class($this)
                      ." have been tried to inserted in the database");
                  throw new \Exception("Too big Name !");
              }
          } else {
              Helpers::log("A not string variable for the name in ". get_class($this)
                  ." have been tried to inserted in the database");
              throw new \Exception("Not well formed Name ! It should be inferior than 128 characters");
          }
      }

      /**
       * Simple name getter
       * @return String $name The Name of the category
       */
      public function getName()
      {
          return $this->name;
      }


      /**
       * Simple setter of the Contents id
       * Check if the Contents id respect the integrity of the database
       * So check if it's an integer or not
       * @param Integer : $contents_id The contents id to be set
       * @return Void
       */
      public function setContents_id($contents_id)
      {
          if(is_int($contents_id)) {
              $this->contents_id = $contents_id;
          } else {
              Helpers::log("A non integer type for a content_id in a menu have tried to be inserted in the database");
              throw new \Exception("You can't enter a non integer type for a content_id in a menu");
          }
      }
      /**
       * Simple content_id getter
       * @return Integer $content_id the id of the linked content
       */
      public function getContent_id()
      {
          return $this->content_id;
      }

  }
