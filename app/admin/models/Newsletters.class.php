<?php

	/** What can do an admin?
	*	He can create a Newsletter -> Constructor
	*	He can Modify the Email -> setEmail
	*	He can list all Subscribers ?
	*	He can add subscriber ?
	*	He can unsubscribe users ?
	*	He can send Email ?
	**/

  namespace App\Admin\Models;


  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\EmailTrait;
  use App\Composite\Traits\Models\GetAllDataTrait;
  use Core\Database\Model;

  /**
   * Model Class who represent a subscriber of the newsletter
   * in the database
   */
  class Newsletters extends Model
  {
    use IdTrait;
    use EmailTrait;
    use GetAllDataTrait;

    protected $id; // id of the email
    protected $email; // The email in the database of the subscriber

    /**
     * Constructor of the Newsletter model class
     * @return Void
     */
    public function __construct($id=-1, $email=null)
      {
        parent::__construct();

          if($id === -1) {
              $this->id = $id;
          } else {
              $this->setId($id);
          }

          if($email === null) {
              $this->email = $email;
          } else {
              $this->setEmail($email);
          }

      }

  }
