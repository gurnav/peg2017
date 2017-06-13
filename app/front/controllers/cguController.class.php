<?php
/**
 * Created by PhpStorm.
 * User: singh
 * Date: 30/04/2017
 * Time: 20:02
 */


namespace App\Front\Controllers;

use Core\Controllers\Controller;
use Core\Views\View;
use Core\Util\Helpers;

class cguController extends Controller
{
    public function cguAction($args)
    {
        session_start();
        $v = new view();
        $v->setViewFront("cgu");
    }
}