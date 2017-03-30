<?php

  namespace Core\Facades;

  use Core\Auth\DBAuth;

  class Auth
  {

    /**
    * Transform call as Static call for Facade uses
    * @param $method : String The name of the called method
    * @param $arguments : Array The list of arguments passed to the method
    * @return result : String The result of our called methods as a String
    */
    public static function __callStatic($method, $arguments)
    {
      $dba = new DBAuth();
      return call_user_func_array([$dba, $method], $arguments);
    }

  }
