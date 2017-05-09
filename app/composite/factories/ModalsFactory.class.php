<?php

  namespace App\Composite\Factories;

  use Core\HTML\Modals;
  use Core\Utils\Helpers;

  /**
   * Class who list all modals of the application
   */
  class ModalsFactory extends Modals
  {

    public static function registerUserForm()
    {

      return [
        "options" => [
          "method"=>"POST",
          "action"=>"register/register",
          "id"=>"register_user",
          "enctype"=>"multipart/form-data",
          "submit"=>"Register"
          ],
        "struct" => [
          "firstname"=>["label"=>"You're firstname : ", "type"=>"text", "placeholder"=>"Firstname", "required"=>"required", "msgerror"=>""],

          "lastname"=>["label"=>"You're lastname : ", "type"=>"text", "placeholder"=>"Lastname", "required"=>"required", "msgerror"=>""],

          "username"=>[ "label"=>"You're username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required", "msgerror"=>"" ],

          "user_email"=>[ "label"=>"You're Email : ", "type"=>"email", "placeholder"=>"Email", "required"=>"required", "errors_msg"=>"" ],

          "user_pwd"=>[ "label"=>"You're Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required", "errors_msg"=>"" ],

          "user_pwd2"=>[ "label"=>"Confirm you're password : ", "type"=>"password", "placeholder"=>"Confirm password", "required"=>"required", "errors_msg"=>"" ],

          "user_img"=>[ "label"=>"Choose you're avatar : ", "type"=>"file", "required"=>"required", "msgerror"=>"" ],
        ]
      ];
    }


    public static function loginUserForm()
    {
      return [
        "options" => [
          "method"=>"POST",
          "action"=>"login/login",
          "id"=>"login_user",
          "enctype"=>"multipart/form-data",
          "submit"=>"Login"
          ],
        "struct" => [
          "username"=>[ "label"=>"You're username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required", "msgerror"=>"" ],

          "user_pwd"=>[ "label"=>"You're Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required", "errors_msg"=>"" ],
        ]
      ];
    }

    public static function loginAdminForm()
    {
      return [
        "options" => [
          "method"=>"POST",
          "action"=>"login/login",
          "enctype"=>"multipart/form-data",
          "submit"=>"Login"
          ],
        "struct" => [

          "username"=>[ "i"=>["class"=>"fa fa-user", "aria-hidden"=>"true"], /*"label"=>"Your username : ",*/ "type"=>"text", "placeholder"=>"Username", "required"=>"required", "id"=>"username" ],

          "password"=>[ "i"=>["class"=>"fa fa-key", "aria-hidden"=>"true"], /*"label"=>"Your Password : ",*/ "type"=>"password", "placeholder"=>"Password", "required"=>"required", "id"=>"password" ],
        ]
      ];
    }

    public static function getAddArticleForm(){
        return [
          "options" => [
              "method"=>"POST",
              "action"=>"",
              "id"=>"add_article_form",
              "enctype"=>"multipart/form-data",
              "submit"=>"Create article"
          ],
          "struct" => [
              "img"=>[ "label"=>"Choose your picture", "type"=>"file", "name"=>"img", "id"=>"img_add_article", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

              "name"=>[ "label"=>"", "type"=>"text", "id"=>"name_add_article", "placeholder"=>"You need to make an existing user", "required"=>0, "errors_msg"=>"" ],

              "title"=>[ "label"=>"", "type"=>"text", "id"=>"title_add_article", "placeholder"=>"Title of your article", "required"=>0, "errors_msg"=>"" ],

              "category"=>[ "label"=>"", "type"=>"checkbox", "name"=>"", "id"=>"", "placeholder"=>"", "required"=>0, "msgerror"=>"" ],

              "content"=>[ "label"=>"", "type"=>"textarea", "id"=>"content_add_article", "placeholder"=>"Description of your article", "required"=>0, "errors_msg"=>"" ]
          ]
        ];
    }


  }
