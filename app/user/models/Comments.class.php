<?php

	namespace App\User\Models;

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

  }
