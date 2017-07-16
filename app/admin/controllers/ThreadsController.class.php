<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Threads;
use App\Admin\Models\Topics;
use Core\Controllers\Controller;
use App\Admin\Models\Users;
use Core\Views\View;
use App\Composite\Factories\ModalsFactory;
use Core\Util\Helpers;

class ThreadsController extends Controller
{

    public function indexAction()
    {

        $v = new View('forum/threads','admin');
        $threads = Threads::getAll();


        for($i =0;$i < count($threads);$i++)
        {
            $threads[$i]["username"] = Users::getUsernameById($threads[$i]["users_id"]);
            $threads[$i]["topicname"] = Threads::getTopicnameById($threads[$i]["topics_id"]);


        }

        $v->assign("threads", $threads);


        if(!empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

    }

    public function addAction()
    {
        $v = new View ('forum/add_thread','admin');
        $topics = Topics::getAll();

        $admin_register_thread = ModalsFactory::getAddThreadForm();
        if (!empty($_SESSION['addThread'])) {
            $admin_register_thread['struct']['title']['value'] = $_SESSION['addThread']['title'];
            $admin_register_thread['struct']['description']['value'] = $_SESSION['addThread']['description'];
            unset($_SESSION['addThread']);
        }
        for($i =0;$i < count($topics);$i++)
        {
            $admin_register_thread['struct']['topic']['value'][]=  $topics[$i]["name"];
        }
        $v->assign('admin_register_thread', $admin_register_thread);

        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {

            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);

        }
    }

    public function updateAction($id_thread)
    {

        $v = new View('forum/add_thread','admin');

        $thread = new Threads();
        $id_thread = $id_thread[0];
        $thread = $thread->populate(['id' => $id_thread]);

        $admin_register_thread = ModalsFactory::getUpdateThreadForm($id_thread);
        $admin_register_thread['struct']['title']['value'] = $thread->getTitle();
        $admin_register_thread['struct']['description']['value'] = $thread->getDescription();

        $topics = Topics::getAll();

        for($i =0;$i < count($topics);$i++)
        {
            $admin_register_thread['struct']['topic']['value'][]=  $topics[$i]["name"];
        }

        $v->assign('admin_register_thread', $admin_register_thread);

        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }
    }

    public function deleteAction($id_thread)
    {

        $thread = new Threads();
        $id_thread = trim($id_thread[0]);
        try {
            $thread = $thread->populate(['id' => $id_thread]);
            $thread->delete();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/threads');


    }


    public function doAddAction()
    {

        $thread = new Threads();
        $_SESSION['errors'] = [];

        try {
            $thread->setTitle($_POST['title']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $thread->setDescription($_POST['description']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $thread->setUsers_id(intval($_SESSION['user']['id']));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $thread->setTopicsId(intval($thread->getTopicIdByName($_POST['topic'])));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            if(empty($_SESSION['errors']))
                $thread->save();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        // If no error login and send him / her on the index of topics
        if(empty($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
            unset($_SESSION['addThread']);
            header('Location: '.BASE_URL.'admin/threads');
        } else {
            $_SESSION['addThread']['name'] = $_POST['title'];
            $_SESSION['addThread']['description'] = $_POST['description'];
            header('Location: '.BASE_URL.'admin/threads/add');
        }
    }

    /**
     * Function for performing the update of the
     * multimedias on the server
     * @return Void
     */
    public function doUpdateAction($id_thread)
    {
        $thread = new Threads();
        $id_thread = trim($id_thread[0]);
        $_SESSION['errors'] = [];
        try {
            $thread = $thread->populate(['id' => $id_thread]);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $thread->setTitle($_POST['title']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $thread->setDescription($_POST['description']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $thread->setTopicsId(intval($thread->getTopicIdByName($_POST['topic'])));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }


        try {
            if(empty($_SESSION['errors']))
                $thread->save();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        // If no error login and send him / her on the home page
        if(empty($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
            header('Location: '.BASE_URL.'admin/threads');
        } else {
            header('Location: '.BASE_URL.'admin/threads/update/'.$thread->getId());
        }
    }





}
/*   Helpers::debugVar($thread->getTopicIdByName($_POST['topic']));
        Helpers::debugVar($thread);
        Helpers::debugVar($_SESSION);
        die();*/
