<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Messages;
use App\Admin\Models\Users;
use Core\Controllers\Controller;
use Core\Views\View;
use App\Composite\Factories\ModalsFactory;
use Core\Util\Helpers;

class MessageController extends Controller
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

        $admin_register_message = ModalsFactory::getAddMessageForm();
        if(!empty($_SESSION['addMessage'])) {
            $admin_register_message['struct']['message']['value'] = $_SESSION['addMessage']['message'];
            unset($_SESSION['addMessage']);
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



    public function deleteAction($content)
    {





    }

//tester tous les champs
    public function doAddAction()
    {
        $message = new Messages();
        $_SESSION['errors'] = [];
        print_r($_POST);
        foreach ($_POST as $post => $value) {
            $cleanedData[$post] = Helpers::cleanString($value);
        }
        try {
            $message->setContent($cleanedData['message']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $message->setUsers_id(intval($_SESSION["admin"]["id"]));
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        try {
            $message->setContents_id(intval(["id"]));
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
            unset($_SESSION['addMessage']);
            header('Location: '.BASE_URL.'admin/messages');
        } else {
            $_SESSION['addMessage']['message'] = $cleanedData['message'];
            header('Location: '.BASE_URL.'admin/messages/add');
        }
    }



}