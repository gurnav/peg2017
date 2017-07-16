<?php

namespace App\Front\Controllers;

use Core\Controllers\Controller;
use Core\Views\View;
use Core\Util\Helpers;

class ContactController extends Controller
{
    public function indexAction($args)
    {
        $v = new View('contact');
    }
}