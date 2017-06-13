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
    protected $users_id; // The author of the message represented by its id

  /**
    * Constructor of the Messages model class
    * @return Void
    */
    public function __construct($id=-1, $users_id=-1,  $threads_id=-1, $content=null)
    {
      parent::__construct();

      $this->setId($id);
      $this->setUsersId($users_id);
      $this->setThreadsId($threads_id);
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
          if (is_int($threadsId)) {
              $this->threadsId = $threadsId;
          } else {
              Helpers::log("A non integer type for a categories id in a content have tried to be inserted in the DB");
              throw new \Exception("You can't enter a non integer type for a categories id of a content");
          }

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
          if(is_string($content)) {
              if(strlen($content) <= 65535) {
                  $this->content = trim($content);
              } else {
                  Helpers::log("A word count superior to 65535 has tried to be created in a new message");
                  throw new \Exception("You can't enter a content with a words count superior to 65535");
              }
          } else {
              Helpers::log("A number has been entered as content in message n° : " . $this->getId());
              throw new \Exception("You can't enter a number as a content !");
          }
      }

      public static function getThreadnameById($id)
      {
          $qb = new QueryBuilder();
          $query = "SELECT title from ".DB_PREFIX."threads WHERE id = '".$id."'";
          $thread = $qb->query($query, null, true);
          return $thread->title;
      }

  }
