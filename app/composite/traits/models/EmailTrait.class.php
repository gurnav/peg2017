<?php

  namespace App\Composite\Traits\Models;

  use Core\Util\Helpers;
  use Core\Facades\Query;

  /**
   * Trait for dealing with getteing and setting an email
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
      if(is_string($setEmail))
      {
        if (filter_var($setEmail, FILTER_VALIDATE_EMAIL))
        {
          $this->email = trim($setEmail);
        } else {
          Helpers::log("A not safe email have been tried to be inserted in the database ! ");
          throw new \Exception("Email not formed correctly !");
        }
      } else {
        Helpers::log("A not string variable for the email in ". get_class($this)
          ." have been tried to inserted in the database");
        throw new \Exception("Incorect email !");
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


    /**
     * Function to check if an email already exist for an user in the database
     * @param String : $email The email to be checked
     * @return String : $error return the error, False instead
     */
    protected function emailExist($email)
    {
      $query = $this->qb->select('email')
              ->from($this->getTable())
              ->where('email=:email');

      $preparedQuery = [':email' => $email];
      $result = $this->qb->prepare($query, $preparedQuery, null, true);

      if(empty($result)) {
        return False;
      } else {
        return True;
      }
    }

  }
