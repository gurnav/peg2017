<?php

  namespace App\Composite\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;

   /**
   * 	Contents Model who reprensent the Messages table
   * 	in the database
   */
  class Message extends Model
  {

    use UsersIdTrait;
    use IdTrait;

    protected $id; // id of the message
    protected $content; // content of the message
    protected $threads_id; // The thread of the message represented by its id
    protected $signaled; // If the comment is reported or not
    protected $users_id; // The author of the message represented by its id

  /**
    * Constructor of the Messages model class
    * @return Void
    */
    public function __construct($id=-1, $users_id=-1,  $threads_id=-1, $signaled=0, $content="")
    {
      parent::__construct();

      $this->setId($id);
      $this->setUsers_id($users_id);
      $this->setThreadsId($threads_id);
      $this->setSignaled($signaled);
      $this->setContent($content);
    }

      /**
       * Simple threads_id getter
       * @return Integer $threads_id The threads_id
       */
      public function getThreadsId()
      {
        return $this->threads_id;
      }

      /**
       * Simple content getter
       * @return String $content The content
       */
      public function getContent()
      {
        return $this->content;
      }

      /**
       * Simple setter of the Thrads id
       * Check if the Threads id respect the integrity of the database
       * So whetever it's a integer or not
       * @param Integer : $content id The content id to be set
       * @return Void
       */
      public function setThreadsId($threadsId)
      {
          if (is_numeric($threadsId)) {
              $this->threads_id = $threadsId;
          } else {
              Helpers::log("A non integer type for a categories id in a content have tried to be inserted in the DB");
              throw new \Exception("You can't enter a non integer type for a categories id of a content");
          }

      }

      /**
       * Simple setter of the signaled
       * Check if the report respect the integrity of the database
       * So whetever it's a integer or not
       * @param Integer : $signaled The flag to be set
       * @return Void
       */
      public function setSignaled($signaled)
      {
          if (is_numeric($signaled)) {
              $this->signaled = $signaled;
          } else {
              Helpers::log("A non integer type for a report in a content have tried to be inserted in the DB");
              throw new \Exception("You can't enter a non integer type for a report of a content");
          }
      }

      /**
       * Simple signaled getter
       * @return Integer $signaled The content
       */
      public function getSignaled()
      {
        return $this->signaled;
      }

      /**
       * Simple setter for the content
       * Check if the Content respect the integrity of the database
       * So if that a string and lesser than 65535
       * @param String : $content The content to be set
       * @return Void
       */
      public function setContent($content)
      {
          if(is_string($content))
          {
              if(strlen($content) <= 65535 )
              {
                  $this->content = trim($content);
              } else {
                  Helpers::log("A word count superior to 65535 has tried to be created in a new message");
                  throw new \Exception("You can't enter a message with a words count superior to 65535");
              }
          } else {
              Helpers::log("A non string type has been entered as content in message n° : " . $this->getId());
              throw new \Exception("You can't enter a non strong type as a massage !");
          }
      }

      public static function getThreadnameById($id)
      {
          $qb = new QueryBuilder();
          $query = "SELECT title from ".DB_PREFIX."threads WHERE id = '".$id."'";
          $thread = $qb->query($query, null, true);
          return $thread->title;
      }

      /**
       * Simple getter of the Category id by name
       * @param string : $name The name to be searched
       * @return string $category_id the id of the linked category
       */
      public function getThreadIdByName($title) {
          $query = "SELECT id from ".DB_PREFIX."threads WHERE title = '".$title."'";
          $thread_id = $this->qb->query($query, null, true);
          return $thread_id->id;
      }


      public static function getNbMessageByThreadId($id) {

          $qb = new QueryBuilder();
          $query = $qb->select('count(*) as nombre')
              ->from(DB_PREFIX."messages")
              ->where("threads_id ='".$id."'")
              ->where("deleted = 0");
          //$query = "SELECT * from ".DB_PREFIX."threads WHERE topics_id = '".$id."' AND deleted = 0";

          $query .= " ORDER BY date_inserted, date_inserted DESC";
          $nbmessages = $qb->query($query, null, false);
          return $nbmessages;
      }

      public static function getAllMessagesByThreadId($id) {

          $qb = new QueryBuilder();
          $query = $qb->select('*')
              ->from(DB_PREFIX."messages")
              ->where("threads_id ='".$id."'")
              ->where("deleted = 0");
          //$query = "SELECT * from ".DB_PREFIX."threads WHERE topics_id = '".$id."' AND deleted = 0";

          $query .= " ORDER BY date_inserted, date_inserted DESC";

          $messages = $qb->query($query, null, false);
          return $messages;
      }

      /**
       * Get all messages with theirs associated users for a specific threads
       *
       * @param threads_id The threads id
       * @return An array of object
       */
      public static function getAllMessagesByThreadIdWithUser($threads_id) {

          $qb = new QueryBuilder();
          $query = "SELECT * FROM ".DB_PREFIX."messages
          INNER JOIN (SELECT id AS uid, username, img FROM hbv_users) AS usr ON usr.uid = ".DB_PREFIX."messages.users_id
          WHERE (".DB_PREFIX."messages.threads_id = ".$threads_id." AND deleted = 0 )".
          " ORDER BY ".DB_PREFIX."messages.date_inserted DESC";

          return $qb->query($query, null, false);
      }

  }
