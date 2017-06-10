<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\GetAllDataTrait;


  /**
   * Model Class who represent a media
   * in the database
   */
  class MediasController extends Controller
  {
      use IdTrait;
      use GetAllDataTrait;


      public function indexAction()
      {
          $v = new View('multimedias');
          echo "Index of Medias<br>";
      }




  }
