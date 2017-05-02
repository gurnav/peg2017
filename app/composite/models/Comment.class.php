<?php

  namespace App\Composite\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;

  /**
   * Contents Model who reprensent the Comments table
   * in the database
   */
  class Comment extends Model
  {

      use UsersIdTrait;
      use IdTrait;

      protected $id; // id of the comment
      protected $content; // content of the comment
      protected $content_id; // The content of the comment represented by its id
      protected $users_id; // The author of the comment represented by its id

      /**
      * Constructor of the Comments model class
      * @return Void
      */
     public function __construct($id = -1, $content = null, $content_id = -1, $users_id = -1)
     {
         parent::__construct();


         $this->setContent($content);
         $this->setDate_inserted($date_inserted);
         $this->setContent_id($content_id);
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
          if (is_string($content)) {
              if(strlen($content) <= 65535) {
                  $this->content = trim($content);
              } else {
                  Helpers::log("A word count superior to 65535 has tried to be created in a new comment");
                  throw new \Exception("You can't enter a content with a words count superior to 65535");
              }
          } else {
              Helpers::log("A non string type has been entered as content in comment n° : " . $this->getId());
              throw new \Exception("You can't enter a number as a content !");
          }

      }

      /**
       * Simple content getter
       * @return String $content The content of the comment
       */
      public function getContent()
      {
          return $this->content;
      }

      /**
       * Simple setter of the Content id
       * Check if the Contents id respect the integrity of the database
       * So whetever it's a integer or not
       * @param Integer : $content id The content id to be set
       * @return Void
       */
      public function setContent_id($content_id)
      {
          if (is_int($content_id)) {
              $this->content_id = $content_id;
          } else {
              Helpers::log("A non integer type for a categories id in a content have tried to be inserted in the DB");
              throw new \Exception("You can't enter a non integer type for a categories id of a content");
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
