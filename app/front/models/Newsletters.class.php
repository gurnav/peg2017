<?php

  namespace App\Front\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Helpers\Traits\Models\IdTrait;
  use App\Helpers\Traits\Models\EmailTrait;

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
        parent::__construct($email=null);

        $this->setEmail($email);
      }
  }
