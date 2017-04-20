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
	class Threads extends Model
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
      public function __construct($id = -1, $title = null, $description = null,
      $users_id = -1, $topics_id = -1)
      {
      	parent::__construct();

      	$this->setId($id);
        $this->setUsersId($users_id);
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
          if (is_int($topicsId)) {
              $this->topicsId = $topicsId;
          } else {
              Helpers::log("A non integer type for a topic id in a thread have tried to be inserted in the DB");
              throw new Exception("You can't enter a non integer type for a topic id of a thread");
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
	      		throw new Exception("You can't enter a title with a words count superior to 255");
	      	}
      	} else {
					Helpers::log("A number has been entered as title in thread n° : " . $this->getId());
					throw new Exception("You can't enter a number as a title !");
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
	      		throw new Exception("You can't enter a description with a words count superior to 255");
	      	}
      	} else {
					Helpers::log("A number has been entered as title in thread n° : " . $this->getId());
					throw new Exception("You can't enter a number as a description !");
				}
      }


  }
