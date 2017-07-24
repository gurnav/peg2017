<?php

  namespace App\Front\Models;

  use Core\Util\Helpers;
  use App\Composite\Models\Message;

   /**
   * 	Contents Model who reprensent the Messages table
   * 	in the database
   */
  class Messages extends Message
  {

    	/**
        * Constructor of the Messages model class
        * @return Void
        */
        public function __construct($id=-1, $users_id=-1,  $threads_id=-1, $content="")
        {
        	parent::__construct($id, $users_id, $threads_id, $content);

        }
  }
