<?php

  namespace App\Composite\Traits\Models;

  use Core\Database\QueryBuilder;

  /**
   * Traint for dealing with getting the id of a model
   */
  trait GetAllDataTrait
  {

    /**
     * Get all contents from the database as an array of Contents object
     * @return Contents Array : $contents All contents in the database
     */
    public function getAll()
    {
      $qb = new QueryBuilder();
      $class_name = get_class($this);
      $query = $qb->select('*')->from($class_name);
      return $qb->query($query, $class_name);
    }

    /**
     * Get all contents related to a user from the database as an array of Contents object
     * TODO Either change the code implementation with Join or Table implementation
     * @param String : $users The username of the user to filter with
     * @return Contents Array : $contents All contents in the database By a specific user
     */
    public function getAllByUsers($users)
    {
      $qb = new QueryBuilder();
      $query_users = $qb->select('id')->from(DB_PREFIX.'users')->where('username='.$users);
      $user = $qb->query($query_users);
      $query = $qb->select('*')->from($this->getTable())->where('users_id='.$user.id);
      return $qb->query($query, get_class($this));
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
      $query = $qb->select('*')->from($this->getTable())->where('categories_id='.$category.id);
      return $qb->query($query, get_class($this));
    }

  }
