<?php

  namespace App\Admin\Models;

  use Core\Database\Model;

  /**
   * Model Which represent the config table
   * in the database
   * Allow configuration for its App
   */
  class Configs extends Model
  {

    /**
     * Constructor of the Users model class
     * @return Void
     */
    public function __construct()
    {
      parent::__construct();
    }


    /**
     * Method V0.1 To change settings
     * @param Array $array the array of settings to be changed
     * @return Void
     */
    public function changeSettings($array)
    {

    }

  }
