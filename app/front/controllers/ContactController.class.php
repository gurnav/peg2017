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
            $contact_form['struct']['msg']['value'] = $_SESSION['contact']['msg'];
            unset($_SESSION['contact']);
        }

        if(!empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

        $v->assign('user_form', $contact_form);
    }

    public function contactAction() {

        if(filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['msg']))
        {
            $admin = new Users();

            $_SESSION['errors'] = [];
            $admin = $admin->populate(['rights' => '3'], false);

            $mail = new Email();
            $msg = strip_tags($_POST['msg'], "<p><a><b><ul><li><ol><u><i><h1><h2>
              <h3><h4><h5><h6><br><div><hr><table><tbody><td><tr><tfoot><th><thead><strong><em>");

            foreach ($admin as $ad) {
                $mail->setAddressee($ad->getEmail());
                $mail->setSubject("Contacted by a user. ");
                $mail->setMessage("From : ".$_POST['user_email'].'<br>'.$msg);
                try {
                    $mail->sendMail();
                } catch (\Exception $e) {
                    $_SESSION['errors'] = 'An error has occured with the mail sending.
                 Please contact the site admnistrator to activate your account with the email you used to subscribe with.';
                }
            }
            $_SESSION['msg'] = "Your messages have been sent to the administrators";
            Routing::index();

        } else {
            $_SESSION['contact']['user_email'] = $_POST['user_email'];
            $_SESSION['contact']['msg'] = $_POST['msg'];
            $_SESSION['errors'] = "Email misformed or message of the contact is empty";
            header('Location: '.BASE_URL.'contact');
        }
    }
}