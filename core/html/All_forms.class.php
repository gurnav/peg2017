<?php
/**
 * Created by PhpStorm.
 * User: singh
 * Date: 10/04/2017
 * Time: 18:15
 */

namespace Core\HTML;


class All_forms extends basesql
{
    /**
     * Simple function for getting the contact form
     * @return array $form the main form
     */
    public function getFormContact(){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_contact_home",
                "enctype"=>"multipart/form-data",
                "submit"=>"Send"
            ],
            "struct" => [
                "name"=>[ "label"=>"", "type"=>"text", "id"=>"name_home", "placeholder"=>"Your name", "required"=>0, "errors_msg"=>"" ],

                "company"=>[ "label"=>"", "type"=>"text", "id"=>"company_home", "placeholder"=>"Your company", "required"=>0, "errors_msg"=>"" ],

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_home", "placeholder"=>"Your email", "required"=>0, "errors_msg"=>"" ],

                "content"=>[ "label"=>"", "type"=>"textarea", "id"=>"content_home", "placeholder"=>"Your message", "required"=>0, "errors_msg"=>"" ]
            ]
        ];
    }


    /**
     * Simple function for getting the add Article form
     * @return array $form the addArticle form
     */
    public function getFormAddArticle(){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_add_article",
                "enctype"=>"multipart/form-data",
                "submit"=>"Create article"
            ],
            "struct" => [
                "img"=>[ "label"=>"Choose your picture", "type"=>"file", "name"=>"img", "id"=>"img_add_article", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "name"=>[ "label"=>"", "type"=>"text", "id"=>"name_add_article", "placeholder"=>"You need to make an existing user", "required"=>0, "errors_msg"=>"" ],

                "title"=>[ "label"=>"", "type"=>"text", "id"=>"title_add_article", "placeholder"=>"Title of your article", "required"=>0, "errors_msg"=>"" ],

                "category_article_mark"=>[ "label"=>"", "type"=>"checkbox", "name"=>"", "id"=>"", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "content"=>[ "label"=>"", "type"=>"textarea", "id"=>"content_add_article", "placeholder"=>"Description of your article", "required"=>0, "errors_msg"=>"" ]
            ]
        ];
    }

    /**
     * Simple function for getting the modify Article form
     * @return array $form the ModifArticle form
     */
    public function getFormModifArticle($id, $img, $pseudo, $title, $content){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_modif_article",
                "enctype"=>"multipart/form-data",
                "submit"=>"Modify this article"
            ],
            "struct" => [

                "id_form"=>[ "label"=>"", "type"=>"hidden", "id"=>"id_modif_article", "value"=>$id, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],

                "img"=>[ "label"=>"Change image here", "type"=>"file", "id"=>"img_modif_article", "value"=>$img, "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "name"=>[ "label"=>"", "type"=>"text", "id"=>"name_modif_article", "value"=>$pseudo, "placeholder"=>"Your name", "required"=>0, "errors_msg"=>"" ],

                "title"=>[ "label"=>"", "type"=>"text", "id"=>"title_modif_article", "value"=>$title, "placeholder"=>"Your company", "required"=>0, "errors_msg"=>"" ],

                "category_article_mark"=>[ "label"=>"", "type"=>"checkbox", "name"=>"", "id"=>"", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "content"=>[ "label"=>"", "type"=>"textarea", "id"=>"content_modif_article", "value"=>$content, "placeholder"=>"Your message", "required"=>0, "errors_msg"=>"" ]
            ]
        ];
    }

    /**
     * Simple function for getting the add User form
     * @return array $form the addUser form
     */
    public function getFormAddUser(){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_add_user",
                "enctype"=>"multipart/form-data",
                "submit"=>"Create user"
            ],
            "struct" => [
                "img"=>[ "label"=>"Choose your picture", "type"=>"file", "name"=>"img", "id"=>"img_add_article", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "pseudo"=>[ "label"=>"", "type"=>"text", "id"=>"pseudo_add_user", "placeholder"=>"Your pseudo", "required"=>0, "errors_msg"=>"" ],

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_add_user", "placeholder"=>"Your email", "required"=>0, "errors_msg"=>"" ],

                "pwd"=>[ "label"=>"", "type"=>"password", "id"=>"pwd_add_user", "placeholder"=>"Your password", "required"=>0, "errors_msg"=>"" ],

                "pwd2"=>[ "label"=>"", "type"=>"password", "id"=>"pwd2_add_user", "placeholder"=>"Confirm your password", "required"=>0, "errors_msg"=>"" ],

                "actif"=>[ "label"=>"", "type"=>"text", "id"=>"actif_add_user", "placeholder"=>"Actif = 1; Not actif = 0", "required"=>0, "errors_msg"=>"" ],

                "profil"=>[ "label"=>"", "type"=>"text", "id"=>"profil_add_user", "placeholder"=>"Choose beetwen : admin / editor or user", "required"=>0, "errors_msg"=>"" ],
            ]
        ];
    }

    /**
     * Simple function for getting the modify Article form
     * @return array $form the modifyArticle form
     */
    public function getFormModifUser($id, $pseudo, $email, $actif, $profil){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_modif_user",
                "enctype"=>"multipart/form-data",
                "submit"=>"Modify"
            ],
            "struct" => [

                "id_form"=>[ "label"=>"", "type"=>"hidden", "id"=>"id_modif_user", "name"=>"file", "value"=>$id, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],

                "img"=>[ "label"=>"Choose your picture", "type"=>"file", "id"=>"img_modif_user", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "pseudo"=>[ "label"=>"", "type"=>"text", "id"=>"pseudo_modif_user", "value"=>$pseudo, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_modif_user", "value"=>$email, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],

                "pwd"=>[ "label"=>"", "type"=>"password", "id"=>"pwd_modif_user", "placeholder"=>"Your password", "required"=>0, "errors_msg"=>"" ],

                "pwd2"=>[ "label"=>"", "type"=>"password", "id"=>"pwd2_modif_user", "placeholder"=>"Confirm your password", "required"=>0, "errors_msg"=>"" ],

                "actif"=>[ "label"=>"", "type"=>"text", "id"=>"actif_modif_user", "value"=>$actif, "placeholder"=>"Actif = 1; Not actif = 0", "required"=>0, "errors_msg"=>"" ],

                "profil"=>[ "label"=>"", "type"=>"text", "id"=>"profil_modif_user", "value"=>$profil, "placeholder"=>"Choose beetwen : admin / editor or user", "required"=>0, "errors_msg"=>"" ],
            ]
        ];
    }

    /**
     * Simple function for getting the add Category form
     * @return array $form the addCat form
     */
    public function getFormAddCat(){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_add_cat",
                "enctype"=>"multipart/form-data",
                "submit"=>"Create category"
            ],
            "struct" => [
                "img"=>[ "label"=>"Choose your picture", "type"=>"file", "name"=>"img", "id"=>"img_add_cat", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "pseudo"=>[ "label"=>"", "type"=>"text", "id"=>"pseudo_add_cat", "placeholder"=>"You need to make an existing user", "required"=>0, "errors_msg"=>"" ],

                "name_cat"=>[ "label"=>"", "type"=>"text", "id"=>"name_add_cat", "placeholder"=>"The name of category", "required"=>0, "errors_msg"=>"" ],
            ]
        ];
    }

    /**
     * Simple function for getting the Modify Category form
     * @return array $form the ModifCat form
     */
    public function getFormModifCategory($id, $pseudo, $name_cat){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_modif_cat",
                "enctype"=>"multipart/form-data",
                "submit"=>"Modify category"
            ],
            "struct" => [

                "id_form"=>[ "label"=>"", "type"=>"hidden", "id"=>"id_modif_article", "value"=>$id, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],

                "img"=>[ "label"=>"Choose your picture", "type"=>"file", "id"=>"img_modif_cat", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "pseudo"=>[ "label"=>"", "type"=>"text", "id"=>"pseudo_modif_cat", "value"=>$pseudo, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],

                "name_cat"=>[ "label"=>"", "type"=>"text", "id"=>"name_modif_cat", "value"=>$name_cat, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],
            ]
        ];
    }


    /**
     * Simple function for getting the subscribe form
     * @return array $form the subscribe form
     */
    public function getFormSubscribe(){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_subscribe",
                "enctype"=>"multipart/form-data",
                "submit"=>"I subscribe !"
            ],
            "struct" => [

                "img"=>[ "label"=>"Choose your picture", "type"=>"file", "id"=>"img_add_article", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "pseudo"=>[ "label"=>"", "type"=>"text", "id"=>"pseudo_add_user", "placeholder"=>"Your pseudo", "required"=>0, "errors_msg"=>"" ],

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_add_user", "placeholder"=>"Your email", "required"=>0, "errors_msg"=>"" ],

                "pwd"=>[ "label"=>"", "type"=>"password", "id"=>"pwd_add_user", "placeholder"=>"Your password", "required"=>0, "errors_msg"=>"" ],

                "pwd2"=>[ "label"=>"", "type"=>"password", "id"=>"pwd2_add_user", "placeholder"=>"Confirm your password", "required"=>0, "errors_msg"=>"" ],

                "General Terms of Use"=>[ "label"=>"", "type"=>"checkbox", "name"=>"cgu", "id"=>"cgu", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],
            ]
        ];
    }

    /**
     * Simple function for getting the connection form
     * @return array $form the connection form
     */
    public function getFormConnection(){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_connection",
                "enctype"=>"multipart/form-data",
                "submit"=>"Connection"
            ],
            "struct" => [

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_user", "placeholder"=>"Your email", "required"=>0, "errors_msg"=>"" ],

                "pwd"=>[ "label"=>"", "type"=>"password", "id"=>"pwd_user", "placeholder"=>"Your password", "required"=>0, "errors_msg"=>"" ],
            ]
        ];
    }

    /**
     * Simple function for getting the profile form
     * @return array $form the profil form
     */
    public function getFormMyProfil($id, $email, $pseudo){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_change_profil",
                "enctype"=>"multipart/form-data",
                "submit"=>"Change profil"
            ],
            "struct" => [

                "id_form"=>[ "label"=>"", "type"=>"hidden", "id"=>"id_modif_user", "name"=>"file", "value"=>$id, "placeholder"=>"", "required"=>0, "errors_msg"=>"" ],

                "img"=>[ "label"=>"Choose your picture", "type"=>"file", "id"=>"img_profil", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

                "pseudo"=>[ "label"=>"", "type"=>"text", "id"=>"pseudo_profil", "value"=>$pseudo, "placeholder"=>"Your pseudo", "required"=>0, "errors_msg"=>"" ],

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_profil", "value"=>$email, "placeholder"=>"Your email", "required"=>0, "errors_msg"=>"" ],

                "pwd"=>[ "label"=>"", "type"=>"password", "id"=>"pwd_profil", "placeholder"=>"Your password", "required"=>0, "errors_msg"=>"" ],

                "pwd2"=>[ "label"=>"", "type"=>"password", "id"=>"pwd2_profil", "placeholder"=>"Confirm your password", "required"=>0, "errors_msg"=>"" ],
            ]
        ];
    }

    /* ----------------------------------------- PARTIE RESET PASSWORD --------------------------------------------- */

    public function getFormGetPass(){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_reset_new_pw",
                "enctype"=>"multipart/form-data",
                "submit"=>"Send"
            ],
            "struct" => [

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_reset", "placeholder"=>"Your email", "required"=>0, "errors_msg"=>"" ],

            ]
        ];
    }


    /**
     * Simple function for getting the reset password form
     * @return array $form the resetPass form
     */
    public function getFormResetPass($email){

        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_new_pw",
                "enctype"=>"multipart/form-data",
                "submit"=>"Send"
            ],
            "struct" => [

                "email"=>[ "label"=>"", "type"=>"text", "id"=>"email_new_reset", "value"=>$email, "placeholder"=>"Your email", "required"=>0, "errors_msg"=>"" ],

                "pwd"=>[ "label"=>"", "type"=>"password", "id"=>"pwd_new_reset", "placeholder"=>"Your new password", "required"=>0, "errors_msg"=>"" ],

                "pwd2"=>[ "label"=>"", "type"=>"password", "id"=>"pwd2_new_reset", "placeholder"=>"Confirm your new password", "required"=>0, "errors_msg"=>"" ],

            ]
        ];
    }

}