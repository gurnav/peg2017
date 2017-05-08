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
     * @return Contents Array : $contents All contents in the database
     */
    public static function getAll()
    {
      $qb = new QueryBuilder();
      // $class = get_class($this);
      $class = explode("\\", self::class);
      $class_name = end($class);
      $query = $qb->select('*')->from(DB_PREFIX.lcfirst($class_name));
      return $qb->query($query, $class_name);
    }

    /**
     * Get all contents related to a user from the database as an array of Contents object
     * TODO Either change the code implementation with Join or Table implementation
     * TODO TO REFACTOR NOT WORKING YET
     * @param String : $users The username of the user to filter with
     * @return Contents Array : $contents All contents in the database By a specific user
     */
    public function getAllByUsers($users)
    {
      $qb = new QueryBuilder();
      $query_users = $qb->select('id')->from(DB_PREFIX.'users')->where('username='.$users);
      $user = $qb->query($query_users);
      $query = $qb->select('*')->from($this->getTable())->where('users_id='.$user->id);
      return $qb->query($query, get_class($this));
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
     * @param String : $categories The category name of the category to filter with
     * @return Contents Array : $contents All contents in the database By a specific user
     */
    public function getAllByCategories($categories)
    {
      $qb = new QueryBuilder();
      $query_categories = $qb->select('categories_id')->from(DB_PREFIX.'categories')->where('name='.$categories);
      $category = $qb->query($query_categories);
      $query = $qb->select('*')->from($this->getTable())->where('categories_id='.$category->id);
      return $qb->query($query, get_class($this));
    }

  }
