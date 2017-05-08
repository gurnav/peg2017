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
        $attributes = ['id', 'title', 'status', 'type', 'date_inserted'];
        $users_attributes = ['username'];
        $contents = Contents::getAllWithUsers('contents', $attributes, $users_attributes);

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
