<?php

  namespace Core\Auth;

  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;

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
        $query = $this->qb->select('id', 'username', 'password', 'rights')
            ->from(DB_PREFIX.'users')
            ->where('username = :username')
            ->where('deleted = 0');
        $user = $this->qb->prepare($query, [':username' => $username], null, true);

        if (!empty($user)) {
            if (password_verify($password, $user->password)) {
                if ($user->rights == 3) {
                    session_regenerate_id(true); // Protection against Session Steal
                    $_SESSION["user"]["id"] = $user->id;
                    $_SESSION["user"]["username"] = $user->username;
                    $_SESSION["user"]["type"] = "admin";
                    return 0;
                } else if ($user->rights == 2) {
                    session_regenerate_id(true); // Protection against Session Steal
                    $_SESSION["user"]["id"] = $user->id;
                    $_SESSION["user"]["username"] = $user->username;
                    $_SESSION["user"]["type"] = "author";
                    return 0;
                } else if ($user->rights == 1) {
                    session_regenerate_id(true); // Protection against Session Steal
                    $_SESSION["user"]["id"] = $user->id;
                    $_SESSION["user"]["username"] = $user->username;
                    $_SESSION["user"]["type"] = "user";
                    return 0;
                }
            } else {
                // Password not match
                return 1;
            }
        }
        // User does not exist
        return -1;
    }

    /**
     * Check if the user is connected or not
     * @return connected : Boolean
     */
    public static function isLogged()
    {
        return isset($_SESSION['user']);
    }


    /**
     * Check if an admin is connected or not
     * @return connected : Boolean
     */
    public static function isAdminLogged()
    {
        $adminLogged = False;

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['type'] === 'admin') {
                $adminLogged = True;
            }
        }

        return $adminLogged;
    }

    /**
     * Safelly destroy a session
     * @return succes : Boolean if the session have been destroyed or not
     */
    public function disconnect()
    {
      try {
        session_destroy();
      } catch (\Exception $e) {
        Helpers::log($e->getMessage());
        die("A fatal error occured !");
      }
    }

  }
