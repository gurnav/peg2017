<?php

  namespace App\Front\Models;

  use Core\Util\Helpers;
  use App\Composite\Models\Comment;

  /**
   * Contents Model who reprensent the Comments table
   * in the database
   */
  class Comments extends Comment
  {

      /**
      * Constructor of the Comments model class
      * @return Void
      */
     public function __construct($id = -1, $content = null, $content_id = -1, $users_id = -1)
     {
         parent::__construct($id, $content, $content_id, $users_id);

     }

     /**
      * Get all comments related to a content from the database as an array of Comments object
      * TODO Either change the code implementation with Join or Table implementation
      * @param Integer : $id The id of the content to filter with
      * @return Comments Array : $comments All comments in the database for a specific content
      */
     public function getAllCommentsByContent($id)
     {
       $query = $this->qb->select('*')->from($this->getTable())->where('content_id='.$id);
       return $this->qb->query($query, get_class($this));
     }

  }
