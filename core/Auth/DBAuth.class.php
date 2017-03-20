<?php

  namespace Core\Auth;

  use Core\Database\QueryBuilder;

  class DBAuth
  {

    private $qb; // An instance of a QueryBuilder object, needed for Injection of dependencies reasons

      /**
       * Constructor of the DBAuth class
       * @return void
       */
      public function __construct (QueryBuilder $qb = null) {
        if($qb === null) {
          $this->qb = new QueryBuilder();
        } else {
          $this->qb = $qb;
        }

      }

    /**
     * Setup The Auth session to the connected user ID
     * @param $username : String
     * @param $password : String
     * @return succes : Boolean If the user is logged or not
     */
    public function login($username, $password)
    {
        $query = $this->qb->select('username', 'password')->from(DB_PREFIX.'users')->where('username = ?');
        $user = $this->qb->prepare($query, [$username], null, true);
        if ($user) {
          if (password_verify($password, $user->password) === TRUE) {
            session_regenerate_id(true); // Protection against Session Steal
            $_SESSION['auth'] = $user->username;
            return true;
          }
        }
        return false;
    }

    /**
     * Check if the user is connected or not
     * @return connected : Boolean
     */
    public function isLogged()
    {
        return isset($_SESSION['auth']);
    }


    /**
     * Safelly destroy a session
     * @return succes : Boolean if the session have been destroyed or not
     */
    public function disconnect()
    {
      try {
        session_destroy();
      } catch (Exception $e) {
        Helpers::log($e->getMessage());
        die("A fatal error occured !");
      }
    }

  }
