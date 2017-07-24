<?php

  namespace App\Composite\Traits\Models;

  use Core\Util\Helpers;

  /**
   * Traint for dealing with getting and setting
   * the users_id
   */
  trait UsersIdTrait
  {

    /**
     * Simple setter of the Users id
     * Check if the Users id respect the integrity of the database
     * So whetever it's a integer or not
     * @param Integer : $users id The users id to be set
     * @return Void
     */
    public function setUsers_id($usersId)
    {
      if(is_numeric($usersId))
      {
        $this->users_id = $usersId;
      } else {
        Helpers::log("A non integer type for a users id in a content have tried to be inserted in the DB");
        throw new \Exception("You can't enter a non integer type for a users id of a content");
      }
    }

    /**
     * Simple users_id getter
     * @return Integer $users_id the id of the linked users
     */
    public function getUsers_id()
    {
      return $this->users_id;
    }

  }
