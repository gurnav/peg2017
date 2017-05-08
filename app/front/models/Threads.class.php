<?php

	namespace App\Front\Models;

  use Core\Util\Helpers;
	use App\Composite\Models\Thread;

	/**
	 * 	Contents Model who reprensent the Threads table
	 * 	in the database
	 */
	class Threads extends Thread
	{

      /**
       * Constructor of the Threads model class
       * @return Void
       */
      public function __construct($id = -1, $title = null, $description = null,
			$users_id = -1, $topics_id = -1)
      {
      	parent::__construct($id, $title, $description, $users_id, $topics_id);

			}

  }
