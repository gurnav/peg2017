<?php

	namespace App\Composite\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;

  /**
	 * 	Contents Model who reprensent the Threads table
	 * 	in the database
	 */
	class Thread extends Model
	{

		use UsersIdTrait;
		use IdTrait;

	    protected $id; // id of the thread
	    protected $title; // Title of the thread
	    protected $description; // description of the thread
	    protected $users_id; // The author of the thread represented by its id
	    protected $topics_id; // The topic of the thread represented by its id

      /**
       * Constructor of the Threads model class
       * @return Void
       */
      public function __construct($id = -1, $title = "", $description = "",
      $users_id = -1, $topics_id = -1)
      {
      	parent::__construct();

      	$this->setId($id);
        $this->setUsers_id($users_id);
        $this->setTopicsId($topics_id);
      	$this->setTitle($title);
      	$this->setDescription($description);
      }

      /**
       * Simple topics_id getter
       * @return Integer $topics_id The topics_id
       */
      public function getTopicsId()
      {
        return $this->topics_id;
      }

      /**
       * Simple title getter
       * @return String $title The title
       */
      public function getTitle()
      {
      	return $this->title;
      }

      /**
       * Simple description getter
       * @return String $description The description
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
      public function setTopicsId($topicsId)
      {
          if (is_numeric($topicsId)) {
              $this->topics_id = $topicsId;
          } else {
              Helpers::log("A non integer type for a topic id in a thread have tried to be inserted in the DB");
              throw new \Exception("You can't enter a non integer type for a topic id of a thread");
          }
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
      	if(is_string($title)) {
      		if(strlen($title) <= 60) {
      			$this->title = trim($title);
      		} else {
	      		Helpers::log("A word count superior to 255 has tried to be created in a new thread");
	      		throw new \Exception("You can't enter a title with a words count superior to 255");
	      	}
      	} else {
					Helpers::log("A number has been entered as title in thread n° : " . $this->getId());
					throw new \Exception("You can't enter a number as a title !");
				}

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
      	if(is_string($description))
				{
      		if(strlen($description) <= 255)
					{
      			$this->description = trim($description);
      		} else {
	      		Helpers::log("A word count superior to 255 has tried to be created in a new thread");
	      		throw new \Exception("You can't enter a description with a words count superior to 255");
	      	}
      	} else {
					Helpers::log("A number has been entered as title in thread n° : " . $this->getId());
					throw new \Exception("You can't enter a number as a description !");
				}
      }


        public static function getTopicnameById($id)
        {
            $qb = new QueryBuilder();
            $query = "SELECT name from ".DB_PREFIX."topics WHERE id = '".$id."'";
            $topic = $qb->query($query, null, true);
            return $topic->name;
        }

        /**
         * Simple getter of the Category id by name
         * @param string : $name The name to be searched
         * @return string $category_id the id of the linked category
         */
        public function getTopicIdByName($name) {
            $query = "SELECT id from ".DB_PREFIX."topics WHERE name = '".$name."'";
            $topic_id = $this->qb->query($query, null, true);
            return $topic_id->id;
        }


        public static function getThreadsNameByTopicId($id)
        {
            $qb = new QueryBuilder();
            $query = "SELECT title from ".DB_PREFIX."threads WHERE topics_id = '".$id."'";
            $thread = $qb->query($query, null, true);
            return $thread->title;

        }

        public static function getThreadById($id) {
            $qb = new QueryBuilder();
            $query = $qb->select('*')
                ->from(DB_PREFIX."threads")
                ->where("id = '".$id."'")
                ->where("deleted = 0");

            // $query .= " ORDER BY date_inserted, date_inserted DESC";

            $topic = $qb->query($query, null, false);
            return $topic;
        }

        public static function getAllThreadsByTopicId($id) {
            $qb = new QueryBuilder();
            $query = $qb->select('*')
                ->from(DB_PREFIX."threads")
                ->where("topics_id ='".$id."'")
                ->where("deleted = 0");
           	// $query = "SELECT * from ".DB_PREFIX."threads WHERE topics_id = '".$id."' AND deleted = 0";
        	$query .= " ORDER BY date_inserted, date_inserted DESC";

            $threads = $qb->query($query, null, false);
            return $threads;
        }


        public static function getNbThreadByTopicId($id) {

            $qb = new QueryBuilder();
            $query = $qb->select('count(*) as nombre')  //20
                ->from(DB_PREFIX."threads")
                ->where("topics_id ='".$id."'")
                ->where("deleted = 0");
           	// $query = "SELECT COUNT(id) from ".DB_PREFIX."threads WHERE topics_id = '".$id."' AND deleted = 0";

            $query .= " ORDER BY date_inserted, date_inserted DESC";

            $nbthreads = $qb->query($query, null, false);
            return $nbthreads;
        }

		/**
		 * Get All Threads with theirs associated users by topic id
		 *
		 */
		public static function getThreadByTopicIdWithUser($topics_id, $one=false) {

			$qb = new QueryBuilder();
            $query = "SELECT *,  (SELECT COUNT(*) FROM ".DB_PREFIX."messages WHERE "
				.DB_PREFIX."messages.threads_id = ".DB_PREFIX."threads.id AND ".DB_PREFIX."messages.deleted = 0) AS nbmsg
  		  	FROM ".DB_PREFIX."threads
            INNER JOIN (SELECT id AS uid, username, img FROM hbv_users) AS usr ON usr.uid = ".DB_PREFIX."threads.users_id
			WHERE ( ".DB_PREFIX."threads.topics_id = ".$topics_id." AND ".DB_PREFIX."threads.deleted = 0 )".
            " ORDER BY ".DB_PREFIX."threads.date_updated, ".DB_PREFIX."threads.date_inserted DESC";

            return $qb->query($query, null, $one);
        }

		/**
         * Retrieve all threds with their associeted users_id
         *
         * @return All threads with their associeted users
         */
        public static function getAllThreadsWithUsers($threads_id=null, $one=false) {
            $qb = new QueryBuilder();
            $query = "SELECT *,  (SELECT COUNT(*) FROM ".DB_PREFIX."messages WHERE "
  		  	.DB_PREFIX."messages.threads_id = ".(($threads_id===null)?DB_PREFIX."threads.id":$threads_id)
  			." AND ".DB_PREFIX."messages.deleted = 0) AS nbmsg
  		  	FROM ".DB_PREFIX."threads
            INNER JOIN (SELECT id AS uid, username, img FROM hbv_users) AS usr ON usr.uid = ".DB_PREFIX."threads.users_id
  		  	WHERE ( ".DB_PREFIX."threads.deleted = 0";
  		  if ($threads_id != null) {
                $query .= " AND ".DB_PREFIX."threads.id = ".$threads_id;
            }
            $query .= " ) ORDER BY ".DB_PREFIX."threads.date_updated, ".DB_PREFIX."threads.date_inserted DESC";

            return $qb->query($query, null, $one);
        }

    }
