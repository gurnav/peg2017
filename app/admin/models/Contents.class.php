<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Util\Helpers;

  /**
   * Contents Model who reprensent the Contents table
   * in the database
   */
  class Contents extends Model
  {
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
     * Simple id getter
     * @return Int $id the id of the content
     */
    public function getId()
    {
      return $this->id;
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
      if(strlen($title) <= 255 ) {
        if(gettype($title) === 'string') {
          $this->title = $title;
        } else {
          Helpers::log("A number has been entered as title in content n° : " . $this->getId());
          die("You can't enter a number as a title !");
        }
      } else {
        Helpers::log("A word count superior to 255 has tried to be created in a new content");
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
     * Simple setter for the title
     * Check if the Content respect the integrity of the database
     * So if that a string and lesser than 65535
     * @param String : $content The content to be set
     * @return Void
     */
    public function setContent($content)
    {
      if(strlen($content) <= 65535 ) {
        if(gettype($content) === 'string') {
          $this->content = $content;
        } else {
          Helpers::log("A number has been entered as content in content n° : " . $this->getId());
          die("You can't enter a number as a content !");
        }
      } else {
        Helpers::log("A word count superior to 65535 has tried to be created in a new content");
        die("You can't enter a content with a words count superior to 65535");
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
      if($status == 0 || $status == 1) {
        $this->status = $status;
      } else {
        Helpers::log("A non boolean type for a content status have tried to be inserted in the DB");
        die("You can't enter a non boolean type for a content status");
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
      if(gettype($isCommentable) === 'integer' && ($isCommentable === 0 || $isCommentable === 1)) {
        $this->isCommentable = $isCommentable;
      } else {
        Helpers::log("A non boolean type for a content status have tried to be inserted in the DB");
        die("You can't enter a non boolean type for a content commentability");
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
      if(gettype($isLikeable) === 'integer' && ($isLikeable === 0 || $isLikeable === 1)) {
        $this->isLikeable = $isLikeable;
      } else {
        Helpers::log("A non boolean type for a content status have tried to be inserted in the DB");
        die("You can't enter a non boolean type for a content likeability");
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
      if(preg_match($categories_id, "/^-?\d*/"))
      {
        $this->categories_id = $categories_id;
      } else {
        Helpers::log("A non integer type for a categories id in a content have tried to be inserted in the DB");
        die("You can't enter a non integer type for a categories id of a content");
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

    /**
     * Simple setter of the Users id
     * Check if the Users id respect the integrity of the database
     * So whetever it's a integer or not
     * @param Integer : $users id The users id to be set
     * @return Void
     */
    public function setUsers_id($usersId)
    {
      if(preg_match($users_id, "/^-?\d*/"))
      {
        $this->users_id = $users_id;
      } else {
        Helpers::log("A non integer type for a users id in a content have tried to be inserted in the DB");
        die("You can't enter a non integer type for a users id of a content");
      }
    }

    /**
     * Simple users_id getter
     * @return Integer $users_id the id of the linked users
     */
    public function getUsers_id()
    {
      return $this->users_id;
    }

  }
