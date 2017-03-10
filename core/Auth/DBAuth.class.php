<?php

  namespace Core\Auth;

use Core\Database\BaseSql;

  class DBAuth
  {
      private $db;

      public function __construct(BaseSql $db)
      {
          $this->db = $db;
      }

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

      public function logged()
      {
          return isset($_SESSION['auth']);
      }
  }
