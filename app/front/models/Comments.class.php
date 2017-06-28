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
     public function __construct($id = -1, $content = "", $content_id = -1, $users_id = -1)
     {
         parent::__construct($id, $content, $content_id, $users_id);

     }

     /**
      * Get all comments related to a content from the database as an array of Comments object
      * TODO Either change the code implementation with Join or Table implementation
      * @return Users : $user All The user related to the comments
      */
     public function getUserByComments()
     {
       $query = $this->qb->select('*')
           ->from(DB_PREFIX."users")
           ->where("id = '".$this->getUsers_id()."'");
       return $this->qb->query($query, "App\Front\Models\Users", true);
     }

  }
