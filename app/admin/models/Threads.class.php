<?php

  namespace App\Admin\Models;

  use Core\Util\Helpers;
  use App\Composite\Models\Thread;
  use App\Composite\Traits\Models\GetAllDataTrait;
  use Core\Database\QueryBuilder;

	/**
	 * 	Contents Model who reprensent the Threads table
	 * 	in the database
	 */
	class Threads extends Thread
	{

      use GetAllDataTrait;

      /**
       * Constructor of the Threads model class
       * @return Void
       */
      public function __construct($id = -1, $title = "", $description = "",
			$users_id = -1, $topics_id = -1) {
      	parent::__construct($id, $title, $description, $users_id, $topics_id);
      }

      /**
       * Get all threads with theirs asociated users by topic
       *
       * @return Array of object
       */
      public static function getAllThreadsWithUserAndTopics($limit=null, $offset=null) {
          $qb = new QueryBuilder();
          $query = "SELECT * FROM ".DB_PREFIX."threads"
            ." INNER JOIN (SELECT id AS uid, username FROM ".DB_PREFIX."users) AS users_table
            ON ".DB_PREFIX."threads.users_id = users_table.uid
            INNER JOIN (SELECT id AS tid, name AS topicname FROM ".DB_PREFIX."topics) AS topics_table
            ON ".DB_PREFIX."threads.topics_id = topics_table.tid
            WHERE ".DB_PREFIX."threads.deleted = 0
            ORDER BY date_inserted";
            if ($limit !== null) $query .= " LIMIT ".$limit;
            if ($offset !== null) $query .= " OFFSET ".$offset;

          return $qb->query($query, null, false);
      }

  }
