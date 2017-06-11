<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\GetAllDataTrait;

  /**
   * Contents Model who reprensent the Topics table
   * in the database
   */
  class Topics extends Model
  {

    use UsersIdTrait;
    use IdTrait;
    use GetAllDataTrait;

      protected $id; // id of the topic
      protected $name; // name of the topic
      protected $description; // description of the topic
      protected $users_id; // The author of the topic represented by its id

      /**
       * Constructor of the Topics model class
       * @return Void
       */

      public function __construct($id = -1, $name = null, $description = null, $users_id = -1)
      {
          parent::__construct();

          $this->setId($id);
          $this->setName($name);
          $this->setDescription($description);
          $this->setUsers_id($users_id);
      }


      public function setName($name)
      {
          if(is_string($name)) {
              if((strlen($name) <= 60)) {
                  $this->name = trim($name);
              } else {
                  Helpers::log("A word count superior to 60 has tried to be created in a new topic");
                  throw new \Exception("You can't enter a name with a words count superior to 60");
              }
          } else {
              Helpers::log("A number has been entered as name in topic n° : " . $this->getId());
              throw new \Exception("You can't enter a number as a name !");
          }

      }

      /**
       * Simple name getter
       * @return String $name The name of the topic
       */

      public function getName()
      {
          return $this->name;
      }

      /**
       * Simple setter for the description
       * Check if the name respect the integrity of the database
       * So if that a string and lesser than 255
       * @param String : $description The description to be set
       * @return Void
       */
      public function setDescription($description)
      {
          if(is_string($description)) {
              if((strlen($description) <= 255)) {
                  $this->description = trim($description);
              } else {
                  Helpers::log("A word count superior to 255 has tried to be created in a new topic");
                  throw new \Exception("You can't enter a description with a words count superior to 255");
              }
          } else {
              Helpers::log("A number has been entered as description in topic n° : " . $this->getId());
              throw new \Exception("You can't enter a number as a description !");
          }
      }

      /**
       * Simple description getter
       * @return String $description The description of the topic
       */

      public function getDescription()

      {
          return $this->description;
      }


  }
