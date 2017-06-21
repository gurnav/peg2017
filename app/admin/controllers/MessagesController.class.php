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


    public function indexAction()
    {

        $v = new View('forum/messages');
        $messages = Messages::getAll();

        for($i =0;$i < count($messages);$i++)
        {
            $messages[$i]["username"] = Users::getUsernameById($messages[$i]["users_id"]);
            $messages[$i]["threadname"] = Messages::getThreadnameById($messages[$i]["threads_id"]);


        }
        $v->assign("messages", $messages);

        if(!empty($SESSION['errors'])) {
            $v->assign('errors', $errors);
            unset($_SESSION['errors']);
        }

    }

    public function addAction()
    {
        $v = new View ('forum/add_message');

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


// A faire pour les messages
    public function updateAction($id_content)
    {
        $v = new View('contents/add_content');
        $content = new Contents();
        $id_content = $id_content[0];
        $content = $content->populate(['id' => $id_content]);
        $admin_register_content = ModalsFactory::getUpdateContentForm($id_content);
        $admin_register_content['struct']['status']['value'] = $content->getStatus();
        $admin_register_content['struct']['title']['value'] = $content->getTitle();
        $admin_register_content['struct']['category']['value'] = $content->getCategoryNameById();
        $admin_register_content['struct']['content']['value'] = $content->getContent();
        $v->assign('admin_register_content', $admin_register_content);
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
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/messages');


    }

//tester tous les champs
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
            $message->setUsers_id(intval($_SESSION['admin']['id']));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            $message->setThreadsId(intval($message->getThreadIdByName($_POST['thread'])));
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

}
/*  Helpers::debugVar($message->getThreadIdByName($_POST['thread']));
        Helpers::debugVar($message);
        Helpers::debugVar($_SESSION);
        die();*/