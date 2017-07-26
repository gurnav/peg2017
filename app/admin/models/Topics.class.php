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

      public function __construct($id = -1, $name = "", $description = "", $users_id = -1)
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


      public function setUsers_id($userId)
      {
          if(is_numeric($userId))
          {
              $this->users_id = $userId;
          } else {
              Helpers::log("A non integer type for a Users id  have tried to be inserted in the DB");
              throw new \Exception("You can't enter a non integer type for a User id");
          }
      }
      public function getUsers_id()
      {
          return $this->users_id;
      }


      /**
       * Retrieve all topics with their associeted users_id
       *
       * @param topics_id The id of the topic that we want further information
       * @return All topics with their associeted users
       */
      public static function getAllTopicsWithUsers($topics_id=null, $one=false, $limit=null, $offset=null) {
          $qb = new QueryBuilder();
          $query = "SELECT *, (SELECT COUNT(*) FROM ".DB_PREFIX."threads WHERE "
            .DB_PREFIX."threads.topics_id = ".(($topics_id===null)?DB_PREFIX."topics.id":$topics_id)
            ." AND ".DB_PREFIX."threads.deleted = 0 ) AS nbthreads
          FROM ".DB_PREFIX."topics
          INNER JOIN (SELECT id AS uid, username, img FROM hbv_users) AS usr ON usr.uid = ".DB_PREFIX."topics.users_id
          WHERE ( ".DB_PREFIX."topics.deleted = 0";
          if ($topics_id != null) {
              $query .= " AND ".DB_PREFIX."topics.id = ".$topics_id;
          }
          $query .= " ) ORDER BY ".DB_PREFIX."topics.date_updated, ".DB_PREFIX."topics.date_inserted DESC";
          if ($limit !== null) $query .= " LIMIT ".$limit;
          if ($offset !== null) $query .= " OFFSET ".$offset;

          return $qb->query($query, null, $one);
      }

      /**
       * Simple getter of the Category name by id
       * @return string $category_name the name of the linked category
       */
      public static function getUsernameById($id)
      {
          $qb = new QueryBuilder();
          $query = "SELECT username from ".DB_PREFIX."users WHERE id = '".$id."'";
          $user = $qb->query($query, null, true);
          return $user->username;
      }


      public static function getTopicById($id) {
          $qb = new QueryBuilder();
          $query = $qb->select('*')
              ->from(DB_PREFIX."topics")
              ->where("id = '".$id."'")
              ->where("deleted = 0");

          // $query .= " ORDER BY date_inserted, date_inserted DESC";

          $topic = $qb->query($query, null, false);
          return $topic;
      }

  }
