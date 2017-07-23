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

        $messages = Messages::getAllMessagesWithUsersAndThreads();
        $v->assign("messages", $messages);

        $topics = Topics::getAllTopicsWithUsers();
        $v->assign("topics", $topics);

        $threads =Threads::getAllThreadsWithUserAndTopics();
        $v->assign("threads", $threads);

        if(!empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }
    }
}
