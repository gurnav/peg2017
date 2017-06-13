<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Threads;
use Core\Controllers\Controller;
use App\Admin\Models\Users;
use Core\Views\View;
use App\Composite\Factories\ModalsFactory;
use Core\Util\Helpers;

class ThreadsController extends Controller
{

    public function indexAction()
    {

        $v = new View("forum/threads");
        $threads = Threads::getAll();


        for($i =0;$i < count($threads);$i++)
        {
            $threads[$i]["username"] = Users::getUsernameById($threads[$i]["users_id"]);
            $threads[$i]["topicname"] = Threads::getTopicnameById($threads[$i]["topics_id"]);


        }

        $v->assign("threads", $threads);


        if(!empty($SESSION['errors'])) {
            $v->assign('errors', $errors);
            unset($_SESSION['errors']);
        }

    }

    public function addAction()
    {

    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }

}
