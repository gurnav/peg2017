<?php

namespace App\Front\Controllers;

use Core\Controllers\Controller;
use Core\Views\View;
use Core\Util\Helpers;

class HelpController extends Controller
{
    public function indexAction()
    {
        $v = new View('help');
    }
}
