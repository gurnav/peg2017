<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Messages;
use App\Admin\Models\Threads;
use App\Admin\Models\Topics;
use Core\Controllers\Controller;
use Core\Views\View;
use App\Admin\Models\Users;
use App\Composite\Factories\ModalsFactory;
use Core\Util\Helpers;


class ManagementController extends Controller
{

    public function indexAction()
    {

        $v = new View('forum/management','admin');

        $messages = Messages::getAll();

        for($i =0;$i < count($messages);$i++)
        {
            $messages[$i]["username"] = Users::getUsernameById($messages[$i]["users_id"]);
            $messages[$i]["threadname"] = Messages::getThreadnameById($messages[$i]["threads_id"]);


        }
        $v->assign("messages", $messages);

        $topics = Topics::getAll();

        for($i =0;$i < count($topics);$i++)
        {
            $topics[$i]["username"] = Users::getUsernameById($topics[$i]["users_id"]);

        }

        $v->assign("topics", $topics);


        $threads =Threads::getAll();

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

    public function updateAction($content)
    {

    }

    public function deleteAction($content)
    {

    }

}
