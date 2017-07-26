<?php

  namespace App\Composite\Traits\Models;

  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;

  /**
   * Traint for dealing with getting the id of a model
   */
  trait GetAllDataTrait
  {

    /**
     * Get all contents from the database as an array of Contents object
     * @param Boolean $order_by_date Allow to order the result by date
     * @return Contents Array : $contents All contents in the database
     */
    public static function getAll($order_by_date=false, $limit=null, $offset=null)
    {
      $qb = new QueryBuilder();
      // $class = get_class($this);
      $class = explode("\\", self::class);
      $class_name = end($class);
      $query = $qb->select('*')->from(DB_PREFIX.lcfirst($class_name))->where("deleted = 0");
      if ($order_by_date === true) {
          $query .= " ORDER BY date_updated, date_inserted DESC";
      }
      if ($limit !== null) $query .= " LIMIT ".$limit;
      if ($offset !== null) $query .= " OFFSET ".$offset;

      return $qb->query($query, $class_name);
    }

    public static function getCount()
    {
        $qb = new QueryBuilder();
        // $class = get_class($this);
        $class = explode("\\", self::class);
        $class_name = end($class);
        $query = "SELECT COUNT(id) AS count FROM ".DB_PREFIX.lcfirst($class_name)." WHERE deleted = 0";

        return $qb->query($query, null, true);
    }

    /**
     * Get all contents related to a user from the database as an array of Contents object
     * TODO Either change the code implementation with Join or Table implementation
     * @param String : $table The table to be joined with the user
     * @param Array : $attributes The attributes to be retrieved from the table
     * @param Array : $users_attributes The users attributes to be retrieved
     * @param String : $users The username of the user to filter with
     * @return Contents Array : $contents All contents in the database By a specific user
     */
    public static function getAllByUsers($table, $attributes, $users)
    {
      $qb = new QueryBuilder();

      for($i = 0; $i < count($attributes); $i += 1) {
        $attributes[$i] = DB_PREFIX.$table.'.'.$attributes[$i];
      }

      $query = "SELECT ".implode(', ', $attributes).', '.implode(', ', $users_attributes)." FROM ".DB_PREFIX.$table." INNER JOIN ".DB_PREFIX."users ON ".DB_PREFIX.$table.".users_id = ".DB_PREFIX."users.id WHERE ".DB_PREFIX."users.username = ".$users;
      return $qb->query($query);
    }

    /**
     * Get all contents with the username instead of the id of the user from the database as an array of Contents object
     * TODO Either change the code implementation with Join or Table implementation
     * @param String : $table The table to be joined with the user
     * @param Array : $attributes The attributes to be retrieved from the table
     * @param Array : $users_attributes The users attributes to be retrieved
     * @return Contents Array : $contents All contents in the database By a specific user
     */
    public static function getAllWithUsers($table, $attributes, $users_attributes)
    {
      $qb = new QueryBuilder();

      for($i = 0; $i < count($attributes); $i += 1) {
        $attributes[$i] = DB_PREFIX.$table.'.'.$attributes[$i];
      }

      for($i = 0; $i < count($users_attributes); $i += 1) {
        $users_attributes[$i] = DB_PREFIX.'users.'.$users_attributes[$i];
      }

      $query = "SELECT ".implode(', ', $attributes).', '.implode(', ', $users_attributes)." FROM ".DB_PREFIX.$table." INNER JOIN ".DB_PREFIX."users ON ".DB_PREFIX.$table.".users_id = ".DB_PREFIX."users.id";
      return $qb->query($query);
    }

    /**
     * Get all contents related to a category from the database as an array of Contents object
     * TODO Either change the code implementation with Join or Table implementation
     * @param String : $table The table to be joined with the user
     * @return Contents Array : $contents All contents in the database By a specific user
     */
    public function getAllByCategories($table, $categories)
    {
      $qb = new QueryBuilder();

      $query = "SELECT * FROM ".DB_PREFIX.$table." INNER JOIN ".DB_PREFIX."categories ON ".DB_PREFIX.$table.".categories_id = ".DB_PREFIX."categories.id WHERE ".DB_PREFIX."categories.name = ".$categories;
      return $qb->query($query);
    }

  }
