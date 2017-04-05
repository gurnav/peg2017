<?php

  namespace App\Helpers\Traits\Models;

  /**
   * Traint for dealing with getting the id of a model
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

  }
