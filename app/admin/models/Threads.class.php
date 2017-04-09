<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Helpers\Traits\Models\UsersIdTrait;
  use App\Helpers\Traits\Models\IdTrait;
  use App\Helpers\Traits\Models\GetAllDataTrait;

  /**
   * Contents Model who reprensent the Threads table
   * in the database
   */
  class Threads extends Model
  {

    use UsersIdTrait;
    use IdTrait;
    use GetAllDataTrait;

      protected $id; // id of the thread
      protected $title; // Title of the thread
      protected $description; // description of the thread
      protected $users_id; // The author of the thread represented by its id
      protected $topics_id; // The topic of the thread represented by its id

      /**
       * Constructor of the Threads model class
       * @return Void
       */
      public function __construct($id = -1, $title = null, $description = null, $users_id = -1, $topics_id = -1)
      {
          parent::__construct();

          $this->setTitle($title);
          $this->setDescription($description);
          $this->setUsers_id($users_id);
          $this->setTopics_id($topics_id);
      }

      /**
       * Simple setter for the title
       * Check if the title respect the integrity of the database
       * So if that a string and lesser than 60
       * @param String : $title The title to be set
       * @return Void
       */
      public function setTitle($title)
      {
          if (strlen($title) <= 60) {
              if (gettype($title) === 'string') {
                  $this->title = trim($title);
              } else {
                  Helpers::log("A number has been entered as title in thread n° : " . $this->getId());
                  die("You can't enter a number as a title !");
              }
          } else {
              Helpers::log("A word count superior to 255 has tried to be created in a new thread");
              die("You can't enter a title with a words count superior to 255");
          }

      }

      /**
       * Simple title getter
       * @return String $title The title of the content
       */
      public function getTitle()

      {
          return $this->title;
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
          if (strlen($description) <= 255) {
              if (gettype($description) === 'string') {
                  $this->description = trim($description);
              } else {
                  Helpers::log("A number has been entered as title in thread n° : " . $this->getId());
                  die("You can't enter a number as a description !");
              }
          } else {
              Helpers::log("A word count superior to 255 has tried to be created in a new thread");
              die("You can't enter a description with a words count superior to 255");
          }
      }

      /**
       * Simple description getter
       * @return String $description The description of the thread
       */
      public function getDescription()

      {
          return $this->description;
      }

      /**
       * Simple setter of the Topics id
       * Check if the Topics id respect the integrity of the database
       * So whetever it's a integer or not
       * @param Integer : $topics id The topics id to be set
       * @return Void
       */
      public function setTopics_id($topics_id)
      {
          if (preg_match($topics_id, "/^-?\d*/")) {
              $this->topics_id = $topics_id;
          } else {
              Helpers::log("A non integer type for a topic id in a thread have tried to be inserted in the DB");
              die("You can't enter a non integer type for a topic id of a thread");
          }
      }

      /**
       * Simple topics_id getter
       * @return Integer $topics_id the id of the linked topics
       */
      public function getTopics_id()
      {
          return $this->topics_id;
      }


  }
