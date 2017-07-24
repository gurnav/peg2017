<?php

	namespace App\Front\Models;

  	use Core\Util\Helpers;
	use Core\Database\QueryBuilder;
	use App\Composite\Models\Thread;
  	use App\Composite\Traits\Models\GetAllDataTrait;

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

  }
