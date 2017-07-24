<?php

  namespace App\Front\Models;

  use Core\Database\QueryBuilder;
  use App\Front\Models\Comments;
  use App\Composite\Models\Content;
  use App\Composite\Traits\Models\GetAllDataTrait;


  /**
   *  Contents class for managing contents in the front end
   */
  class Contents extends Content
  {

      use GetAllDataTrait;

      /**
       * Constructor of the Contents model class
       * @return Void
       */
      public function __construct($id=-1, $title='', $content='', $status='0',
      $type='page', $isCommentable='0', $isLikeable='0', $categories_id=-1, $thumbnails_id=0, $users_id=-1)
      {
        parent::__construct($id, $title, $content, $status, $type, $isCommentable, $isLikeable,
            $categories_id, $thumbnails_id, $users_id);
      }


    /**
     * Get all contents from the database by type as an array of Contents object
     * @param String $type : The type of the researched contents
     * @param Boolean $order_by_date : If the Array of contents should be ordered by date
     * @return Contents Array : $contents All contents in the database
     */
    public static function getAllByType($type, $order_by_date = false)
    {
      $qb = new QueryBuilder();
      // $class = get_class($this);
      $class = explode("\\", self::class);
      $class_name = end($class);
      $query = $qb->select('*')
        ->from(DB_PREFIX.lcfirst($class_name))
        ->where("type = '".$type."'")
        ->where("status = 1")
        ->where("deleted = 0");
      if ($order_by_date === true) {
          $query .= " ORDER BY date_updated, date_inserted DESC";
      }
      return $qb->query($query, $class_name);
    }


    /**
     * Retrieve all the commentaries associated to a contents with is id
     * @param int $id : The id of the contents
     * @return Array Comments : Return an array of comments object
     */
    public function getAllCommentsFromContentID()
    {
        $query = $this->qb->select('*')
            ->from(DB_PREFIX."comments")
            ->where("contents_id = '".$this->getId()."'")
            ->where("deleted = 0");
        $query .= " ORDER BY date_updated, date_inserted DESC";

        return $this->qb->query($query, "App\Front\Models\Comments");
    }


    /**
     * Get last three contents
     *
     * @param $content_type the type of the content you want to retrieve
     * @param $limit The number of content you want to retrieve
     * @return Return an array of contents
     */
    public static function getContentsWithUsers($content_type="", $limit=0)
    {
        $qb = new QueryBuilder();
        $query = "SELECT * FROM ".DB_PREFIX."contents
        INNER JOIN (SELECT id AS iid, name, path AS thumbnails FROM ".DB_PREFIX."multimedias) AS multimedias_table
        ON ".DB_PREFIX."contents.thumbnails_id = multimedias_table.iid
        WHERE (".((empty($content_type))?"":DB_PREFIX."contents.type='".$content_type."' AND ")
            .DB_PREFIX."contents.deleted=0 AND ".DB_PREFIX."contents.status=1)
        ORDER BY 'date_inserted' ".(($limit!==0)?"LIMIT ".$limit:"");

        return $qb->query($query, null, false);
    }

}
