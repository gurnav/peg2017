<?php

  namespace App\Admin\Controllers;

  use App\Admin\Models\Comments;
  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Composite\Factories\ModalsFactory;
  use App\Admin\Models\Users;

  class CommentsController extends Controller
  {

    public function indexAction()
    {
        $v = new View('comments/comments');
        $comments = Comments::getAll();

        for($i = 0; $i < count($comments); $i += 1)
        {
            $comments[$i]["username"] = Users::getUsernameById($comments[$i]["users_id"]);
        }

        $v->assign('comments', $comments);

        if(!empty($SESSION['errors'])) {
            $v->assign('errors', $errors);
            unset($_SESSION['errors']);
        }
    }


  }
