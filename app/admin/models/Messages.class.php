<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Helpers\Traits\Models\UsersIdTrait;
  use App\Helpers\Traits\Models\IdTrait;
  use App\Helpers\Traits\Models\GetAllDataTrait;

  /**
   * Contents Model who reprensent the Messages table
   * in the database
   */
  class Messages extends Model
  {

    use UsersIdTrait;
    use IdTrait;
    use GetAllDataTrait;

      protected $id; // id of the message
      protected $content; // content of the message
      protected $threads_id; // The thread of the message represented by its id
      protected $users_id; // The author of the message represented by its id

      /**
       * Constructor of the Messages model class
       * @return Void
       */
      public function __construct($id = -1, $content = null, $threads_id = -1, $users_id = -1)
      {
          parent::__construct();

          $this->setId($id);
          $this->setContent($content);
          $this->setThreads_id($threads_id);
          $this->setUsers_id($users_id);
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
          if (strlen($content) <= 65535) {
              if (gettype($content) === 'string') {
                  $this->content = trim($content);
              } else {
                  Helpers::log("A number has been entered as content in message n° : " . $this->getId());
                  die("You can't enter a number as a content !");
              }
          } else {
              Helpers::log("A word count superior to 65535 has tried to be created in a new message");
              die("You can't enter a content with a words count superior to 65535");
          }
      }

      /**
       * Simple content getter
       * @return String $content The content of the message
       */

      public function getContent()
      {
          return $this->content;
      }

      public function setThreads_id($threads_id)
      {
          if (preg_match($threads_id, "/^-?\d*/")) {
              $this->threads_id = $threads_id;
          } else {
              Helpers::log("A non integer type for a threads id in a message have tried to be inserted in the DB");
              die("You can't enter a non integer type for a threads id of a message");
          }
      }

      /**
       * Simple threads_id getter
       * @return Integer $threads_id the id of the linked threads
       */

      public function getThreads_id()
      {
          return $this->threads_id;
      }


  }
