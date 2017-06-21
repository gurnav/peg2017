<?php

namespace App\Admin\Controllers;


use App\Admin\Models\Newsletters;
use Core\Controllers\Controller;
use Core\Views\View;
use Core\Util\Helpers;
use App\Composite\Factories\ModalsFactory;


class NewslettersController extends Controller
{
    public function indexAction()
    {
        $v = new View('newsletters/newsletters');
        $subscribes = Newsletters::getAll();
        $v->assign("subscribes", $subscribes);

        if(!empty($SESSION['errors'])) {
            $v->assign('errors', $errors);
            unset($_SESSION['errors']);
        }
    }
    public function deleteAction($news_id)
    {
        $newsletter = new Newsletters();
        $news_id = trim($news_id[0]);

        try {
            $newsletter = $newsletter->populate(['id' => $news_id]);
            $newsletter->delete();
        } catch (Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }
        header('Location: '.BASE_URL.'admin/newsletters');

    }


    public function addAction()
    {
        $v = new View ('newsletters/add_newsletter');
        $admin_register_newsletter = ModalsFactory::getAddNewsletterForm();
        if (!empty($_SESSION['addNewsletter'])) {
            $admin_register_newsletter['struct']['email']['value'] = $_SESSION['addNewsletter']['email'];
            unset($_SESSION['addNewsletter']);
        }
        $v->assign('admin_register_newsletter', $admin_register_newsletter);

        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {

            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);

        }
    }

    public function doAddAction()
    {

        $newsletter = new Newsletters();
        $_SESSION['errors'] = [];

        try {
            $newsletter->setEmail($_POST['email']);
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        try {
            if(empty($_SESSION['errors']))
                $newsletter->save();
        } catch (\Exception $e) {
            array_push($_SESSION['errors'], $e->getMessage());
        }

        // If no error login and send him / her on the index of topics
        if(empty($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
            unset($_SESSION['addNewsletter']);
            header('Location: '.BASE_URL.'admin/newsletters');
        } else {
            $_SESSION['addNewsletter']['email'] = $_POST['email'];
            header('Location: '.BASE_URL.'admin/newsletters/add');
        }
    }


}
/*  Helpers::debugVar($newsletter);
               Helpers::debugVar($news_id);
               Helpers::debugVar($_SESSION);
               die();*/