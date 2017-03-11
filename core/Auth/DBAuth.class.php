<?php

  namespace Core\Auth;

  use Core\Database\BaseSql;
  use Core\Database\QueryBuilder;

  class DBAuth
  {
      private $db;

      /**
       * Constructor of our class
       * Which setup the connection to the database
       * @return void
       */
      public function __construct(BaseSql $db)
      {
          $this->db = $db;
      }

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
     * @param $username : String
     * @param $password : String
     * @return Boolean If the user is logged or not
     */
    public function login($username, $password)
    {
        $user = $this->db->prepare('SELECT * FROM'.DB_PREFIX.'users WHERE username = ?', [$username], null, true);
        if ($user) {
            if ($user->password === sha1($password)) {
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
