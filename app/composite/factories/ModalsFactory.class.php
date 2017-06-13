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


      public static function getAddMessageForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/message/doAdd",
                  "id"=>"admin_register_message",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Add message"
              ],
              "struct" => [

                "content" => ["label"=>"The content of your message","type"=>"text", "placeholder"=>"content of your message", "required"=>0, "error_msg"=>"" ],

              ]
          ];
      }

      //use by topic controller
      public static function getAddTopicForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/topics/doAdd",
                  "id"=>"admin_register_topic",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Add topic"
              ],
              "struct" => [

                  "name" => ["label"=>"The name of your topic","type"=>"text", "placeholder"=>"name of your message", "required"=>0, "error_msg"=>"" ],
                  "description" => ["label"=>"The description of your topic","type"=>"text", "placeholder"=>"content of your message", "required"=>0, "error_msg"=>"" ],
                 // "user" => ["label"=>"User who add the Topic","type"=>"text", "placeholder"=>"name of the user", "required"=>0, "error_msg"=>"" ],

              ]
          ];
      }


      public static function PostThreadUserForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=>"",
                  "enctype"=>"multipart/form-data",
                  "submit"=>""
              ],
              "struct" => [

                  "title" => ["type"=>"text", "placeholder"=>"Title of your Thread", "required"=>"required", "id"=>"messagebox" ],
                  "description" => ["type"=>"text", "placeholder"=>"Description of the Thread", "required"=>"required", "id"=>"messagebox" ],

              ]
          ];
      }

      public static function PostTopicAdminForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=>"",
                  "enctype"=>"multipart/form-data",
                  "submit"=>""
              ],
              "struct" => [

                  "title" => ["type"=>"text", "placeholder"=>"Title of your Thread", "required"=>"required", "id"=>"messagebox" ],
                  "description" => ["type"=>"text", "placeholder"=>"Description of your Thread", "required"=>"required", "id"=>"messagebox" ],

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
