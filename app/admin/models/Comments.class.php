<?php

  namespace App\Admin\Models;

  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Models\Comment;
  use App\Composite\Traits\Models\GetAllDataTrait;

  /**
   * Contents Model who reprensent the Comments table
   * in the database
   */
  class Comments extends Comment
  {
      use GetAllDataTrait;

      /**
      * Constructor of the Comments model class
      * @return Void
      */
     public function __construct($id = -1, $content = "", $content_id = -1, $users_id = -1)
     {
         parent::__construct($id, $content, $content_id, $users_id);

     }

     /**
      * Get all comments with theirs associaeted users and contents
      *
      * @return Array of categories with their associated users
      */
     public static function getAllCategoriesWithUsersAndContents() {
         $qb = new QueryBuilder();
         $query = "SELECT * FROM ".DB_PREFIX."comments"
           ." INNER JOIN (SELECT id AS uid, username FROM ".DB_PREFIX."users) AS users_table
           ON ".DB_PREFIX."comments.users_id = users_table.uid
           INNER JOIN (SELECT id AS cid, title AS contentname FROM ".DB_PREFIX."contents) AS contents_table
           ON ".DB_PREFIX."comments.contents_id = contents_table.cid
           WHERE ".DB_PREFIX."comments.deleted = 0
           ORDER BY date_inserted";

         return $qb->query($query, null, false);
     }

  }
