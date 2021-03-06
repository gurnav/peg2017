<?php

  namespace App\Composite\Factories;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;

  /**
   * Factory class for cretating content automatically
   */
  class ContentsFactory
  {

      /**
       * Factory content creator
       * @return Object Contents : The content created with a type
       */
      public static function create($class)
      {
        if($class === 'Article' || $class === 'News')
        {
          $content = new Contents();
          $content->setIsCommentable(1);
          $content->setIsLikeable(1);
          return $content;
        } elseif($class === 'Page') {
          return new Contents();
        } else {
          Helpers::log('The Contents Factory can\'t create a non existing type.');
          return null;
        }

      }
  }

    /**
     * Contents Model who reprensent the Contents table
     * in the database
     */
    class Contents extends Model
    {
      use UsersIdTrait;
      use IdTrait;

      protected $id; // id of the content
      protected $title; // Title of the content
      protected $content; // The content
      protected $status; // The Status of the content so whetever it's validated or not
      protected $type; // Type of the content (News, Page, Article)
      protected $isCommentable; // If the content is commentable
      protected $isLikeable; // If the content is likeable
      protected $categories_id; // The category of the content represented by its id
      protected $users_id; // The author of the content represented by its id

      /**
       * Constructor of the Contents model class
       * @return Void
       */
      public function __construct($id=-1, $title=null, $content=null, $status='0',
      $type='Page', $isCommentable='0', $isLikeable='0', $categories_id=-1, $users_id=-1)
      {
        parent::__construct();

        $this->setId($id);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setStatus($status);
        $this->setType($type);
        $this->setIsCommentable($isCommentable);
        $this->setIsLikeable($isLikeable);
        $this->setCategories_id($categories_id);
        $this->setUsers_id($users_id);
      }

      /**
       * Simple setter for the title
       * Check if the title respect the integrity of the database
       * So if that a string and lesser than 255
       * @param String : $title The title to be set
       * @return Void
       */
      public function setTitle($title)
      {
        if(gettype($title) === 'string')
        {
          if(strlen($title) <= 255 )
          {
            $this->title = trim($title);
          } else {
            Helpers::log("A word count superior to 255 has tried to be created in a new title content");
            throw new \Exception("You can't enter a content title with a words count superior to 255");
          }
        } else {
          Helpers::log("A non string type has been entered as content in content n° : " . $this->getId());
          throw new \Exception("You can't enter a non strong type as a tile !");
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
       * Simple setter for the title
       * Check if the Content respect the integrity of the database
       * So if that a string and lesser than 65535
       * @param String : $content The content to be set
       * @return Void
       */
      public function setContent($content)
      {
        if(gettype($content) === 'string')
        {
          if(strlen($content) <= 65535 )
          {
            $this->content = trim($content);
          } else {
            Helpers::log("A word count superior to 65535 has tried to be created in a new content");
            throw new \Exception("You can't enter a content with a words count superior to 65535");
          }
        } else {
          Helpers::log("A non string type has been entered as content in content n° : " . $this->getId());
          throw new \Exception("You can't enter a non strong type as a content !");
        }
      }

      /**
       * Simple title getter
       * @return String $content The content
       */
      public function getContent()
      {
        return $this->content;
      }

      /**
       * Simple setter of the Status
       * Check if the status respect the integrity of the database
       * So whetever it's a Boolean or not
       * @param Integer : $status The status to be set
       * @return Void
       */
      public function setStatus($status)
      {
        if($status == '0' || $status == '1') {
          $this->status = $status;
        } else {
          Helpers::log("A non boolean type for a content status have tried to be inserted in the DB");
          throw new \Exception("You can't enter a non boolean type for a content status");
        }
      }

      /**
       * Simple status getter
       * @return Integer : $status The status whetever is valited or not
       */
      public function getStatus()
      {
        return $this->status;
      }

      /**
       * Simple type getter
       * @return String $type The type of the content (News, Page, Article)
       */
      public function getType()
      {
        return $this->type;
      }

      /**
       * Simple setter of the isCommentable value
       * Check if the isCommentable respect the integrity of the database
       * So whetever it's a Boolean or not
       * @param Integer : $isCommentable The isCommentable status to be set
       * @return Void
       */
      public function setIsCommentable($isCommentable)
      {
        if($isCommentable == '0' || $isCommentable === '1') {
          $this->isCommentable = $isCommentable;
        } else {
          Helpers::log("A non boolean type for a content status have tried to be inserted in the DB");
          throw new \Exception("You can't enter a non boolean type for a content commentability");
        }
      }

      /**
       * Simple icCommentable getter
       * @return Integer $isCommentable If the content is commentable or not
       */
      public function getIsCommentable()
      {
        return $this->isCommentable;
      }

      /**
       * Simple setter of the isLikeable
       * Check if the isLikeable respect the integrity of the database
       * So whetever it's a Boolean or not
       * @param Integer : $title The isLikeable status to be set
       * @return Void
       */
      public function setIsLikeable($isLikeable)
      {
        if($isLikeable == '0' || $isLikeable == '1') {
          $this->isLikeable = $isLikeable;
        } else {
          Helpers::log("A non boolean type for a content status have tried to be inserted in the DB");
          throw new \Exception("You can't enter a non boolean type for a content likeability");
        }
      }

      /**
       * Simple isLikeable getter
       * @return Integer $isCommentable If the content is likeable or not
       */
      public function getIsLikeable()
      {
        return $this->isLikeable;
      }

      /**
       * Simple setter of the Categories id
       * Check if the categories id respect the integrity of the database
       * So whetever it's a integer or not
       * @param Integer : $categories id The categories id to be set
       * @return Void
       */
      public function setCategories_id($categoriesId)
      {
        if(is_numeric($categoriesId))
        {
          $this->categories_id = $categoriesId;
        } else {
          Helpers::log("A non integer type for a categories id in a content have tried to be inserted in the DB");
          throw new \Exception("You can't enter a non integer type for a categories id of a content");
        }
      }

      /**
       * Simple categories_id getter
       * @return Integer $categories_id the id of the linked category
       */
      public function getCategories_id()
      {
        return $this->categories_id;
      }


    }
