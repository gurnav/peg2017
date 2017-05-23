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
          "firstname"=>["label"=>"Your firstname : ", "type"=>"text", "placeholder"=>"Firstname", "required"=>"required", "msgerror"=>""],

          "lastname"=>["label"=>"Your lastname : ", "type"=>"text", "placeholder"=>"Lastname", "required"=>"required", "msgerror"=>""],

          "username"=>[ "label"=>"Your username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required", "msgerror"=>"" ],

          "user_email"=>[ "label"=>"Your Email : ", "type"=>"email", "placeholder"=>"Email", "required"=>"required", "errors_msg"=>"" ],

          "user_pwd"=>[ "label"=>"Your Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required", "errors_msg"=>"" ],

          "user_pwd2"=>[ "label"=>"Confirm Your password : ", "type"=>"password", "placeholder"=>"Confirm password", "required"=>"required", "errors_msg"=>"" ],

          "user_img"=>[ "label"=>"Choose Your avatar : ", "type"=>"file", "required"=>"required", "msgerror"=>"" ],
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
          "username"=>[ "label"=>"Your username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required", "msgerror"=>"" ],

          "user_pwd"=>[ "label"=>"Your Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required", "errors_msg"=>"" ],
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

    public static function getAddContentForm()
    {
        return [
            "options" => [
                "method" => "POST",
                "action" => BASE_URL."admin/contents/doAdd/",
                "id" => "admin_register_content",
                "enctype" => "multipart/form-data",
                "submit" => "Add Content"
            ],
            "struct" => [

                "title" => ["label" => "Title here", "type" => "text", "name" => "contentTitle", "required" => "required", "placeholder" => "Insert your title here"],

                "status" => ["label" => "Choose status", "type" => "text", "name" => "status", "id" => "add_status", "placeholder" => "status", "required" => 0, "msgerror" => ""],

                "type" =>["label" => "Choose type", "type" => "text", "name" => "type", "id" => "", "placeholder" => "type", "required" => 0, "msgerror" => ""],

                "category" => ["label" => "The category", "type" => "text", "name" => "", "id" => "", "placeholder" => "", "required" => 0, "msgerror" => "category"],

                "content" => ["label" => "The content", "type" => "text", "id" => "content_add_article", "placeholder" => "Description of your article", "required" => 0, "errors_msg" => ""]
            ]
        ];
    }

      public static function getUpdateContentForm($content)
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=>BASE_URL."admin/contents/doUpdate/".$content,
                  "id"=>"admin_register_content",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Update Content"
              ],
              "struct" => [
                  "status"=>["label"=>"The status : ", "type"=>"text", "placeholder"=>"Firstname", "required"=>"required" ],

                  "title"=>["label"=>"The title : ", "type"=>"text", "placeholder"=>"Title", "required"=>"required" ],

                  "category"=>[ "label"=>"The Category : ", "type"=>"text", "placeholder"=>"Category", "required"=>"required" ],

                  "content"=>[ "label"=>"The content : ", "type"=>"text", "placeholder"=>"Content", "required"=>"required" ],
              ]
          ];
      }

    public static function adminAddUserForm()
    {
      return [
        "options" => [
          "method"=>"POST",
          "action"=>BASE_URL."admin/users/doAdd",
          "id"=>"admin_register_user",
          "enctype"=>"multipart/form-data",
          "submit"=>"Add User"
          ],
        "struct" => [
          "firstname"=>["label"=>"The firstname : ", "type"=>"text", "placeholder"=>"Firstname", "required"=>"required" ],

          "lastname"=>["label"=>"The lastname : ", "type"=>"text", "placeholder"=>"Lastname", "required"=>"required" ],

          "username"=>[ "label"=>"The username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required" ],

          "user_email"=>[ "label"=>"The Email : ", "type"=>"email", "placeholder"=>"Email", "required"=>"required" ],

          "user_pwd"=>[ "label"=>"The Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required" ],

          "user_pwd2"=>[ "label"=>"Confirm The password : ", "type"=>"password", "placeholder"=>"Confirm password", "required"=>"required" ],

          "user_rights"=>["label"=>"Rights of the user", "type"=>"radio", "required"=>"required", "value"=>["User"=>1, "Writer"=>2, "Admin"=>3], "checked"=>1 ],

          "user_status"=>["label"=>"Status of the user", "type"=>"radio", "required"=>"required", "value"=>["Pending"=>0, "Rejected"=>-1, "Validated"=>1], "checked"=>0 ],

          "user_img"=>[ "label"=>"Choose The avatar : ", "type"=>"file", "required"=>"required", "msgerror"=>"" ]
        ]
      ];
    }


    public static function adminUpdateUserForm($user)
    {
      return [
        "options" => [
          "method"=>"POST",
          "action"=>BASE_URL."admin/users/doUpdate/".$user,
          "id"=>"admin_register_user",
          "enctype"=>"multipart/form-data",
          "submit"=>"Update User"
          ],
        "struct" => [
          "firstname"=>["label"=>"The firstname : ", "type"=>"text", "placeholder"=>"Firstname", "required"=>"required" ],

          "lastname"=>["label"=>"The lastname : ", "type"=>"text", "placeholder"=>"Lastname", "required"=>"required" ],

          "username"=>[ "label"=>"The username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required" ],

          "user_email"=>[ "label"=>"The Email : ", "type"=>"email", "placeholder"=>"Email", "required"=>"required"  ],

          // "user_pwd"=>[ "label"=>"The Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required" ],

          // "user_pwd2"=>[ "label"=>"Confirm The password : ", "type"=>"password", "placeholder"=>"Confirm password", "required"=>"required" ],

          "user_rights"=>["label"=>"Rights of the user : ", "type"=>"radio", "required"=>"required", "value"=>["User"=>1, "Writer"=>2, "Admin"=>3] ],

          "user_status"=>["label"=>"Status of the user : ", "type"=>"radio", "required"=>"required", "value"=>["Pending"=>0, "Rejected"=>-1, "Validated"=>1] ],

          "user_img"=>[ "label"=>"Choose The avatar : ", "type"=>"file", "required"=>"required", "msgerror"=>"" ],
        ]
      ];
    }


  }
