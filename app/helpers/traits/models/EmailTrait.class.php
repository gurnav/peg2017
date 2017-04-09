<?php

  namespace App\Helpers\Traits\Models;

  use Core\Util\Helpers;

  /**
   * Traint for dealing with getteing and setting an email
   */
  trait EmailTrait
  {

    /**
     * Simple Email setter
     * Check if the email respect the integrity of the database
     * @param String : $setEmail The email to be setted
     * @return Void
     */
    public function setEmail($setEmail)
    {
      if(gettype($setEmail) === 'string')
      {
        if (filter_var($setEmail, FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL))
        {
          $this->email = trim($setEmail);
        } else {
          Helpers::log("A not safe email have been tried to be inserted in the database ! ");
          die("Email not formed correctly !");
        }
      } else {
        Helpers::log("A not string variable for the email in ". get_class($this)
          ." have been tried to inserted in the database");
        die("Incorect email !");
      }
    }


    /**
     * Simple email getter
     * @return String $email The email
     */
    public function getEmail()
    {
        return $this->email;
    }

  }
