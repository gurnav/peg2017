<?php

  namespace App\Helpers\Traits\Models;

  /**
   * Trait for dealing with getting the id of a model
   */
  trait IdTrait
  {

      /**
       * Simple id getter
       * @return Int $id the id of the model in the DB
       */
      public function getId()
      {
        return $this->id;
      }

      /**
       * ID Setter for the class only
       * @param Int : $id The id to be set
       * @return Void
       */
      public function setId($id)
      {
        if(preg_match($id, "/-?\d+/") === 1)
        {
          $this->id = $id;
        }
      }

  }
