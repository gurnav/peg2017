<?php

  namespace Core\Auth;

  use Core\Database\QueryBuilder;

  class DBAuth
  {

      /**
       * Constructor of our class
       * @return void
       */
      public function __construct () {}

      /**
       * Get the user ID if he is connected
       * @return $_SESSION or false is the user isn't connected
       */
      public function getUserId()
      {
          if ($this->logged()) {
              return $_SESSION['auth'];
          }
          return false;
      }

    /**
     * Setup The Auth session to the connected user ID
     * @param $username : String
     * @param $password : String
     * @return Boolean If the user is logged or not
     */
    public function login($username, $password)
    {
        $qb = new QueryBuilder();
        $query = $qb->select('id', 'username', 'password')->from(DB_PREFIX.'users')->where('username = ?');
        $user = $qb->prepare($query, [$username], null, true);
        if ($user) {
          if (password_verify($password, $user->password) === TRUE) {
            $_SESSION['auth'] = $user->id;
            return true;
          }
        }
        return false;
    }

    /**
     * Check if the user is connected or not
     * @return connected : Boolean
     */
    public function logged()
    {
        return isset($_SESSION['auth']);
    }

  }
