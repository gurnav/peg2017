<?php

  namespace App\Front\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Admin\Models\Multimedias;

  /**
   * Controller for Gallery related actions
   */
  class GalleryController extends Controller
  {

      /**
       * Function for showing the gallery on the site
       * @return Void
       */
      public function indexAction()
      {
          $v = new View('gallery');
          $medias = Multimedias::getAll();
          $v->assign('medias', $medias);
      }


  }
