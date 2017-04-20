<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\GetAllDataTrait;

  class Categories extends Model
  {

    use UsersIdTrait;
    use IdTrait;
    use GetAllDataTrait;

    protected $id;
    protected $name;
    protected $description;
    protected $users_id;


    /**
     * Constructor of the Categories model class
     * @return Void
     */
    public function __construct($id=-1, $name=null, $description=null, $users_id=-1)
    {
        parent::__construct();

        $this->setId($id);
        $this->setName($name);
        $this->setDescription($description);
        $this->setUsers_id($users_id);
    }

    /**
       * Simple setter for the name of a category
       * Check if the category name respect the integrity of the database
       * So if that a string and lesser than 255
       * @param String : $name The Name to be set
       * @return Void
       */
      public function setName($name){
          if(is_string($name))
          {
              if(strlen($name) <= 128)
              {
                  $this->name = trim($name);
              } else {
                  Helpers::log("A string bigger than 128 char for the name in ". get_class($this)
                      ." have been tried to inserted in the database");
                  throw new Exception("Too big Name !");
              }
          } else {
              Helpers::log("A not string variable for the name in ". get_class($this)
                  ." have been tried to inserted in the database");
              throw new Exception("Not well formed Name ! It should be inferior than 128 characters");
          }
      }

      /**
       * Simple name getter
       * @return String $name The Name of the category
       */
      public function getName(){
          return $this->Name;
      }

      /**
       * Simple setter for the description
       * Check if the description respect the integrity of the database
       * So if that a string and lesser than 255
       * @param String : $description The description to be set
       * @return Void
       */
      public function setDescription($description){
          if(is_string($description))
          {
              if(strlen($description) <= 255 )
              {
                  $this->description=trim($description);
              } else {
                  Helpers::log("A word count superior to 255 has tried to be created in a new description");
                  throw new Exception("You can't enter a description with a words count superior to 255");
              }
          } else {
              Helpers::log("A non string type has been entered as description in description n° : " . $this->getId());
              throw new Exception("You can't enter a non strong type as a description !");
          }
      }

      /**
       * Simple title getter
       * @return String $description The description
       */
      public function getDescription(){
          return $this->description;
      }
  }
