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
        $v = new View('comments/comments', 'admin');
        $comments = Comments::getAll(true);

        for($i = 0; $i < count($comments); $i += 1)
        {
            $comments[$i]["username"] = Users::getUsernameById($comments[$i]["users_id"]);
            $comments[$i]["contentname"] = Comments::getContentNameById($comments[$i]["contents_id"]);
        }

        $v->assign('comments', $comments);

        if(!empty($_SESSION['errors'])) {
            $v->assign('errors',$_SESSION['errors']);
            unset($_SESSION['errors']);
        }
    }


    public function deleteAction($id_comment)
    {
      $comments = new Comments();
        $id_comment = trim($id_comment[0]);
      try {
          $comments = $comments->populate(['id' => $id_comment]);
          $comments->delete();
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }
      header('Location: '.BASE_URL.'admin/comments');
    }


  }
