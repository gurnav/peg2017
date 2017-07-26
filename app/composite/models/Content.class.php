<?php

  namespace App\Composite\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;

  /**
   * Contents Model who reprensent the Contents table
   * in the database
   */
  class Content extends Model
  {
    use UsersIdTrait;
    use IdTrait;

    protected $id; // id of the content
    protected $title; // Title of the content
    protected $content; // The content
    protected $status; // The Status of the content so whetever it's validated or not
    protected $type; // Type of the content (News, Page, Article)
    // protected $isCommentable; // If the content is commentable
    // protected $isLikeable; // If the content is likeable
    protected $categories_id; // The category of the content represented by its id
    protected $thumbnails_id; // The image id which represent the thumbnails for a content
    protected $users_id; // The author of the content represented by its id

    /**
     * Constructor of the Contents model class
     * @return Void
     */
    public function __construct($id=-1, $title='', $content='', $status='0',
        $type='page', $categories_id=-1, $thumbnails_id=0,
        $users_id=-1)
    {
      parent::__construct();

      $this->setId($id);
      $this->setTitle($title);
      $this->setContent($content);
      $this->setStatus($status);
      $this->setType($type);
      // $this->setIsCommentable($isCommentable);
      // $this->setIsLikeable($isLikeable);
      $this->setCategories_id($categories_id);
      $this->setThumbnails_id($thumbnails_id);
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
      if(is_string($title))
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
      if(is_string($content))
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
      if(is_numeric($status)) {
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
       * Simple setter of the type
       * Check if the type respect the integrity of the database
       * So whetever it's a Boolean or not
       * @param string : $type The type to be set
       * @return Void
       */
      public function setType($type)
      {
          if($type == "news" || $type == "page" || $type == "article") {
              $this->type = $type;
          } else {
              Helpers::log("A non string type for a content type have tried to be inserted in the DB");
              throw new \Exception("You can't enter a content type");
          }
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
      if($isCommentable == '0' || $isCommentable == '1') {
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

    /**
     * Simple setter of the Categories id
     * Check if the categories id respect the integrity of the database
     * So whetever it's a integer or not
     * @param Integer : $categories id The categories id to be set
     * @return Void
     */
    public function setThumbnails_id($thumbnails_id)
    {
      if(is_numeric($thumbnails_id))
      {
        $this->thumbnails_id = $thumbnails_id;
      } else {
        Helpers::log("A non integer type for a thumbnails_id id in a content have tried to be inserted in the DB");
        throw new \Exception("You can't enter a non integer type for a thumbnails id of a content");
      }
    }

    /**
     * Simple categories_id getter
     * @return Integer $categories_id the id of the linked category
     */
    public function getThumbnails_id()
    {
      return $this->thumbnails_id;
    }

    /**
     * Get all contents matching a certains research
     *
     * @param $search The string searched
     * @param $search_type Where we should search in the contents
     * @param $contents_type The contents type to search
     * @return Array of Contents object
     */
    public static function searchInContents($search, $search_type, $contents_type) {
        $qb = new QueryBuilder();
        if ($search_type === 'title') {
            $query =  'SELECT * FROM '.DB_PREFIX.'contents';
            $query .= " INNER JOIN (SELECT id AS cid, name AS category_name FROM ".DB_PREFIX."categories) AS categories_table
            ON ".DB_PREFIX."contents.categories_id = categories_table.cid";
            $query .= " INNER JOIN (SELECT id AS uid, username FROM ".DB_PREFIX."users) AS users_table
            ON ".DB_PREFIX."contents.users_id = users_table.uid";
            $query .= " INNER JOIN (SELECT id AS iid, name, path AS thumbnails FROM ".DB_PREFIX."multimedias) AS multimedias_table ON ".DB_PREFIX."contents.thumbnails_id = multimedias_table.iid ";
            $query .= ' WHERE ( '.DB_PREFIX.'contents.type = \''.$contents_type.'\' AND '.DB_PREFIX.'contents.title LIKE \'%'.$search.'%\'';
            $query .= ' AND '.DB_PREFIX.'contents.deleted = 0 AND '.DB_PREFIX.'contents.status = 1 )';
            $query .= ' ORDER BY '.DB_PREFIX.'contents.date_updated, '.DB_PREFIX.'contents.date_inserted DESC';
        } elseif ($search_type === 'category') {
            $query = "SELECT * FROM ".DB_PREFIX."contents
                      INNER JOIN (SELECT id AS iid, name, path AS thumbnails FROM ".DB_PREFIX."multimedias) AS multimedias_table ON ".DB_PREFIX."contents.thumbnails_id = multimedias_table.iid
                      INNER JOIN (SELECT id AS cid, name AS category_name FROM ".DB_PREFIX."categories) AS categories_table ON ".DB_PREFIX."contents.categories_id = categories_table.cid
                      INNER JOIN (SELECT id AS uid, username FROM ".DB_PREFIX."users) AS users_table
                      ON ".DB_PREFIX."contents.users_id = users_table.uid
                      WHERE ( ".DB_PREFIX."contents.type = '".$contents_type."' AND categories_table.category_name = '".$search."' AND "
                        .DB_PREFIX."contents.deleted = 0 AND ".DB_PREFIX."contents.status = 1)
                      ORDER BY ".DB_PREFIX."contents.date_updated, ".DB_PREFIX."contents.date_inserted DESC";
        }



        return $qb->query($query, null, false);
    }


  }
