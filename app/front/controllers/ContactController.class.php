<?php

namespace App\Front\Controllers;

use App\Composite\Models\User;
use Core\Controllers\Controller;
use Core\Views\View;
use Core\Util\Helpers;
use Core\Route\Routing;
use Core\Email\Email;
use App\Front\Models\Users;
use App\Composite\Factories\ModalsFactory;

class ContactController extends Controller
{
    public function indexAction($args)
    {
        $v = new View('contact');

        $contact_form = ModalsFactory::ContactForm();
        if(!empty($_SESSION['contact'])) {
            $contact_form['struct']['user_email']['value'] = $_SESSION['contact']['user_email'];
        }

        if(!empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
        }

        $v->assign('user_form', $contact_form);
        unset($_SESSION['errors']);
    }

    public function contactAction(){

        if(empty($_SESSION['errors']))
        {

            $user = new Users();
            $_SESSION['errors'] = [];


            $mail = new Email();
            $mail->setAddressee($user->getEmail());
            $mail->setSubject("Contact at ".SITE_NAME.".");
            $mail->setMessage("$msg"."<br>"
                ."Cheers,"."<br>"
                ." The team of ".SITE_NAME);
            try {
                $mail->sendMail();
            } catch (\Exception $e) {
                $_SESSION['msg'] = 'An error has occured with the mail sending.
                 Please contact the site admnistrator to activate your account with the email you used to subscribe with.';
            }

            Routing::index();
        } else {
            $_SESSION['contact']['user_email'] = $_POST['user_email'];
            header('Location: '.BASE_URL.'contact');
        }
    }
}