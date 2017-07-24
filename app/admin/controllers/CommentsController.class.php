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
        $comments = Comments::getAllCategoriesWithUsersAndContents();

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

    public function updateAction($id_comment)
    {
        $v = new View('comments/add_comment', 'admin');
        $comment = new Comments();
        $id_comment = $id_comment[0];
        $comment = $comment->populate(['id' => $id_comment]);
        $admin_register_comment = ModalsFactory::getUpdateCommentForm($id_comment);
        $admin_register_comment['struct']['content']['value'] = $comment->getContent();
        $v->assign('admin_register_comment', $admin_register_comment);
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }
    }
    public function doUpdateAction($id_comment)
    {
        $comment = new Comments();
        $id_comment = trim($id_comment[0]);
        $_SESSION['errors'] = [];
        /*foreach ($_POST as $post => $value) {
            $cleanedData[$post] = Helpers::cleanString($value);
        }*/
        try {
            $comment = $comment->populate(['id' => $id_comment]);
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $comment->setContent($_POST['content']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            if(empty($_SESSION['errors']))
                $comment->save();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        // If no error login and send him / her on the home page
        if(empty($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
            header('Location: '.BASE_URL.'admin/comments');
        } else {
            header('Location: '.BASE_URL.'admin/comments/update/'.$comment->getId());
        }
    }
}
