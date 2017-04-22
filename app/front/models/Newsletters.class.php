<?php

  namespace App\Front\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\EmailTrait;

  /**
   * Model Class who represent a subscriber of the newsletter
   * in the database
   */
  class Newsletters extends Models
  {

    use IdTrait;
    use EmailTrait;

    protected $email; // The email in the database of the subscriber

    /**
     * Constructor of the Newsletter model class
     * @return Void
     */
    public function __construct()
      {
        parent::__construct($id=-1, $email=null);

        $this->setId($id);
        $this->setEmail($email);
      }
  }
