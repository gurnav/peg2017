<?php

  namespace App\Admin\Models;

  use Core\Util\Helpers;
  use Core\Database\QueryBuilder;
  use App\Composite\Traits\Models\GetAllDataTrait;
  use App\Composite\Models\Message;

   /**
   * 	Contents Model who reprensent the Messages table
   * 	in the database
   */
  class Messages extends Message
  {

      use GetAllDataTrait;

    	/**
        * Constructor of the Messages model class
        * @return Void
        */
        public function __construct($id=-1, $users_id=-1,  $threads_id=-1, $content="")
        {
        	parent::__construct($id, $users_id, $threads_id, $content);

        }


        /**
         * Return all messages associated to theirs user by threads
         *
         * @return Array of object
         */
        public static function getAllMessagesWithUsersAndThreads($limit=null, $offset=null) {
            $qb = new QueryBuilder();
            $query = "SELECT * FROM ".DB_PREFIX."messages"
              ." INNER JOIN (SELECT id AS uid, username FROM ".DB_PREFIX."users) AS users_table
              ON ".DB_PREFIX."messages.users_id = users_table.uid
              INNER JOIN (SELECT id AS tid, title AS threadname FROM ".DB_PREFIX."threads) AS threads_table
              ON ".DB_PREFIX."messages.threads_id = threads_table.tid
              WHERE ".DB_PREFIX."messages.deleted = 0
              ORDER BY date_inserted";
              if ($limit !== null) $query .= " LIMIT ".$limit;
              if ($offset !== null) $query .= " OFFSET ".$offset;

            return $qb->query($query, null, false);
        }

  }
