<?php

  namespace App\Front\Models;

  use Core\Database\Model;
  use Core\Util\Helpers;
  use App\Helpers\Traits\Models\GetAllDataTrait;


  class Contents extends Model
  {
    use GetAllDataTrait;

    /**
     * Constructor of the Contents model class
     * @return Void
     */
    public function __construct()
    {
      parent::__construct();

    }


    /**
     * Get all contents related to a category from the database as an array of Contents object
     * TODO Either change the code implementation with Join or Table implementation
     * @param String : $order The type of order we want to filter with
     * @return Contents Array : $contents All contents in the database By a specific user
     */
    public function getAllOrderedByDate($order)
    {
      $qb = new QueryBuilder();
      $query = $qb->select('*')->from($this->getTable())->orderBy('date_inserted', $order);
      return $qb->query($query, get_class($this));
    }

  }
