<?php

	namespace App\User\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Helpers\Traits\Models\UsersIdTrait;
  use App\Helpers\Traits\Models\IdTrait;

	 /**
	  * 	Model Class who represent a comment
   	* 	in the database
   	*/
   	class Comments extends Model
   	{

   		use UsersIdTrait;
   		use IdTrait;

  	protected $id; // The id in the database of the message
  	protected $users_id; // The id in the database of the user
    protected $contents_id; //The id in the database of the comments
    protected $content; // The content in the database of the comments

    /**
    * Constructor of the Comments model class
    * @return Void
    */
    public function __construct($id=-1, $users_id=-1,  $contents_id=-1, $content=null)
    {
    	parent::__construct();

    	$this->setId($id);
    	$this->setUsersId($users_id);
    	$this->setContentsId($contents_id);
    	$this->setContent($content);
    }

      /**
       * Simple contents_id getter
       * @return Integer $contents_id The contents_id
       */
      public function getContentsId()
      {
      	return $this->contents_id;
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
       * Simple setter of the Content id
       * Check if the Contents id respect the integrity of the database
       * So whetever it's a integer or not
       * @param Integer : $content id The content id to be set
       * @return Void
       */

      public function setContentId($contentId)
      {
          if (preg_match($contentId, "/^-?\d*/")) {
              $this->contentId = $contentId;
          } else {
              Helpers::log("A non integer type for a categories id in a content have tried to be inserted in the DB");
              die("You can't enter a non integer type for a categories id of a content");
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
       	if (strlen($content) <= 65535) {
       		if (gettype($content) === 'string') {
       			$this->content = trim($content);
       		} else {
       			Helpers::log("A number has been entered as content in comment n° : " . $this->getId());
       			die("You can't enter a number as a content !");
       		}
       	} else {
       		Helpers::log("A word count superior to 65535 has tried to be created in a new comment");
       		die("You can't enter a content with a words count superior to 65535");
       	}

       }

   }
