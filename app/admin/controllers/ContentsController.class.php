<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Admin\Models\Contents;

  class ContentsController extends Controller
  {

    public function indexAction()
    {
        $v = new View('contents');

        $contents = Contents::getAll();

        $v->assign('contents', $contents);
    }

    public function addAction()
    {
        $v = new View('addContents');
    }

    public function updateAction()
    {
        //$v = new View('modifyContents');
    }

    public function deleteAction()
    {
        //$v = new View('deleteContents');
    }

  }
