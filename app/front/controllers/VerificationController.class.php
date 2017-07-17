<?php

    namespace App\Front\Controllers;

    use App\Front\Models\Users;
    use Core\Controllers\Controller;
    use Core\Views\View;

    /**
     * Class for verifying email and stuff
     * related to an user
     */
    class VerificationController extends Controller {

        /**
         * Check if an email verify an account
         * @param $args Array The array of args
         * @return Void
         */
        public function emailAction($args) {
            $v = new View('email_verification');
            $encryptedEmail = $args[0];
            $email = openssl_decrypt($encryptedEmail, "aes-256-cbc", "esgi-geographic", 0, "AzErTyU123456789");

            $user = new Users();
            $user = $user->populate(['email' => $email]);

            if ($user->getId() !== -1) {
                if ($user->getStatus() == 0) {
                    try {
                      $user->setStatus(1);
                      $user->save();
                    } catch (\Exception $e) {
                      $msg = "An error has occured please contact the site admnistrator";
                    }
                    $msg = "Your account has been verified";
                } else {
                    $msg = "Your account have been already verified";
                }
            } else {
                $msg = "You are not registered";
            }

            $v->assign('msg', $msg);
            if (isset($error)) {
                $v->assign('error', $error);
            }
        }

    }
