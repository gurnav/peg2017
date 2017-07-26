<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Messages;
use App\Admin\Models\Threads;
use App\Admin\Models\Users;
use Core\Controllers\Controller;
use Core\Views\View;
use App\Composite\Factories\ModalsFactory;
use Core\Util\Helpers;

class MessagesController extends Controller
{

    public function indexAction($args)
    {
        $v = new View('forum/messages','admin');

        if (empty($args)) {
            $pagination = 1;
        } else {
            $pagination = intval($args[0]);
        }

        $offset = ($pagination * 10) - 10;
        $messages = Messages::getAllMessagesWithUsersAndThreads(10, $offset);

        $v->assign('count', Messages::getCount()->count);
        $v->assign("messages", $messages);

        if(!empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

    }

    public function addAction()
    {
        $v = new View ('forum/add_message','admin');

        $threads = Threads::getAll();
        $admin_register_message = ModalsFactory::getAddMessageForm();
        if(!empty($_SESSION['addMessage'])) {
            $admin_register_message['struct']['content']['value'] = $_SESSION['addMessage']['content'];

            unset($_SESSION['addMessage']);
        }
        for($i =0;$i < count($threads);$i++)
        {
            $admin_register_message['struct']['thread']['value'][]=  $threads[$i]["title"];
        }
        $v->assign('admin_register_message', $admin_register_message);
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

    }

    public function updateAction($id_message)
    {
        $v = new View('forum/add_message','admin');
        $message = new Messages();

        $id_message = $id_message[0];
        $message = $message->populate(['id' => $id_message]);

        $admin_register_message = ModalsFactory::getUpdateMessageForm($id_message);
        $admin_register_message['struct']['content']['value'] = $message->getContent();

        $threads = Threads::getAll();

        for($i = 0; $i < count($threads); $i++)
        {
            $admin_register_message['struct']['thread']['value'][] =  $threads[$i]["title"];
        }

        $v->assign('admin_register_message', $admin_register_message);

        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }
    }

    public function deleteAction($id_message)
    {
        $message = new Messages();
        $id_message = trim($id_message[0]);
        try {
            $message = $message->populate(['id' => $id_message]);
            $message->delete();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/messages');

    }


    public function doAddAction()
    {

        $message = new Messages();
        $_SESSION['errors'] = [];


        try {
            $message->setContent($_POST['content']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $message->setUsers_id(intval($_SESSION['user']['id']));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $message->setThreadsId(intval($message->getThreadIdByName($_POST['thread'])));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        $signaled = (($_POST['signaled'] === 'signaled') ? 1 : 0);

        try {
            $message->setSignaled($signaled);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            if(empty($_SESSION['errors']))
                $message->save();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }



        // If no error login and send him / her on the index of topics
        if(empty($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
            unset($_SESSION['addMessage']);
            header('Location: '.BASE_URL.'admin/messages');
        } else {
            $_SESSION['addMessage']['content'] = $_POST['content'];
            header('Location: '.BASE_URL.'admin/messages/add');
        }
    }

    /**
     * Function for performing the update of the
     * multimedias on the server
     * @return Void
     */
    public function doUpdateAction($id_message)
    {
        $message = new Messages();
        $id_message = trim($id_message[0]);
        $_SESSION['errors'] = [];
        try {
            $message = $message->populate(['id' => $id_message]);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $message->setContent($_POST['content']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $message->setThreadsId(intval($message->getThreadIdByName($_POST['thread'])));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        $signaled = (($_POST['signaled'] === 'signaled') ? 1 : 0);

        try {
            $message->setSignaled($signaled);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            if(empty($_SESSION['errors']))
                $message->save();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        // If no error login and send him / her on the home page
        if(empty($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
            header('Location: '.BASE_URL.'admin/messages');
        } else {
            header('Location: '.BASE_URL.'admin/messages/update/'.$message->getId());
        }
    }
}
