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
          "firstname"=>["label"=>"Your firstname : ", "type"=>"text", "placeholder"=>"Firstname", "required"=>"required", "i_class"=>"fa fa-tag", "msgerror"=>""],

          "lastname"=>["label"=>"Your lastname : ", "type"=>"text", "placeholder"=>"Lastname", "required"=>"required", "i_class"=>"fa fa-list-alt", "msgerror"=>""],

          "username"=>[ "label"=>"Your username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required", "i_class"=>"fa fa-user", "msgerror"=>"" ],

          "user_email"=>[ "label"=>"Your Email : ", "type"=>"email", "placeholder"=>"Email", "required"=>"required", "i_class"=>"fa fa-envelope", "errors_msg"=>"" ],

          "user_pwd"=>[ "label"=>"Your Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required", "i_class"=>"fa fa-key", "errors_msg"=>"" ],

          "user_pwd2"=>[ "label"=>"Confirm Your password : ", "type"=>"password", "placeholder"=>"Confirm password", "required"=>"required", "i_class"=>"fa fa-key", "errors_msg"=>"" ],

          "user_newsletters"=>["label"=>"Newsletters", "type"=>"radio", "value"=>["Dont subscribe"=>0, "Subscribe"=>1], "checked"=>0, "i_class"=>"fa fa-info" ],

          "user_img"=>[ "label"=>"Choose Your avatar : ", "type"=>"file", "required"=>"required", "i_class"=>"fa fa-picture-o", "msgerror"=>"" ],
        ]
      ];
    }

    public static function ContactForm()
    {
      return [
          "options" => [
              "method"=>"POST",
              "action"=>"contact/contact",
              "id"=>"contact_user",
              "enctype"=>"multipart/form-data",
              "submit"=>"Send"
          ],
          "struct" => [
              "user_email"=>[ "label"=>"Your Email : ", "type"=>"email", "placeholder"=>"Email", "required"=>"required", "i_class"=>"fa fa-envelope", "errors_msg"=>""],
              "msg"=>[ "label"=>"Your Message : ", "type"=>"textarea", "placeholder"=>"Your Message here", "required"=>"required", "errors_msg"=>""]
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
          "username"=>[ "label"=>"Your username : ", "type"=>"text", "placeholder"=>"Username", "required"=>"required", "i_class"=>"fa fa-user", "msgerror"=>"" ],

          "user_pwd"=>[ "label"=>"Your Password : ", "type"=>"password", "placeholder"=>"Password", "required"=>"required", "i_class"=>"fa fa-key", "errors_msg"=>"" ],
        ]
      ];
    }

    public static function forgotPasswordForm()
    {
      return [
        "options" => [
          "method"=>"POST",
          "action"=>"send_new_password",
          "id"=>"email_user",
          "enctype"=>"multipart/form-data",
          "submit"=>"Get a new password"
          ],
        "struct" => [
            "user_email"=>[ "label"=>"Your Email : ", "type"=>"email", "placeholder"=>"Email", "required"=>"required", "i_class"=>"fa fa-envelope"],
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

    //use by topic controller
      public static function getAddTopicForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/topics/doAdd/",
                  "id"=>"admin_register_topic",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Add Topic"
              ],
              "struct" => [

                  "name" => ["label"=>"The name of your topic","type"=>"text", "placeholder"=>"name of your message", "required"=>0, "error_msg"=>"" ],
                  "description" => ["label"=>"The description of your topic","type"=>"textarea", "placeholder"=>"description of your topic", "required"=>0, "error_msg"=>"" ]

              ]
          ];
      }

      public static function getAddThreadForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/threads/doAdd/",
                  "id"=>"admin_register_thread",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Add Thread"
              ],
              "struct" => [

                  "title" => ["label"=>"The name of your title","type"=>"text", "placeholder"=>"name of your title", "required"=>0, "error_msg"=>"" ],
                  "description" => ["label"=>"The description of your thread","type"=>"textarea", "placeholder"=>"description of your thread", "required"=>0, "error_msg"=>"" ],
                  "topic" => ["label" => "Choose your topic", "type" => "selected", "name" => "","value"=>"", "id" => "", "placeholder" => "name of your topic", "required" => 0, "error_msg" => "topicChoose"]
                  // "user" => ["label"=>"User who add the Topic","type"=>"text", "placeholder"=>"name of the user", "required"=>0, "error_msg"=>"" ],

              ]
          ];
      }

      public static function getAddMessageForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/messages/doAdd",
                  "id"=>"admin_register_message",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Add Message"
              ],
              "struct" => [

                  "content" => ["label"=>"The content of your message","type"=>"textarea", "placeholder"=>"content of your message", "required"=>0, "error_msg"=>"" ],
                  "thread" => ["label" => "Choose your thread", "type" => "selected", "name" => "listofThread", "value"=>"", "id" => "", "placeholder" => "name of your thread", "required" => 0, "error_msg" => "threadChoose"]

              ]
          ];
      }
      public static function getAddNewsletterForm()
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/newsletters/doAdd",
                  "id"=>"admin_register_newsletter",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Add Newsletter"
              ],
              "struct" => [

                  "email" => ["label" => "Enter email for subscribe", "type" => "text", "value"=>"", "id" => "", "placeholder" => "email for subscribe", "required" => 0, "error_msg" => ""]

              ]
          ];
      }


      public static function getUpdateTopicForm($topic)
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=>BASE_URL."admin/topics/doUpdate/".$topic,
                  "id"=>"admin_register_topic",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Update Topic"
              ],
              "struct" => [

                  "name" => ["label"=>"The name of your topic","type"=>"text", "placeholder"=>"name of your message", "required"=>0, "error_msg"=>"" ],
                  "description" => ["label"=>"The description of your topic","type"=>"textarea", "placeholder"=>"description of your topic", "required"=>0, "error_msg"=>"" ]

              ]
          ];
      }
      public static function getUpdateThreadForm($thread)
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/threads/doUpdate/".$thread,
                  "id"=>"admin_register_thread",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Update Thread"
              ],
              "struct" => [

                  "title" => ["label"=>"The name of your title","type"=>"text", "placeholder"=>"name of your title", "required"=>0, "error_msg"=>"" ],
                  "description" => ["label"=>"The description of your thread","type"=>"textarea", "placeholder"=>"description of your thread", "required"=>0, "error_msg"=>"" ],
                  "topic" => ["label" => "Choose your topic", "type" => "selected", "name" => "", "id" => "", "placeholder" => "name of your topic", "required" => 0, "error_msg" => "topicChoose"]

              ]
          ];
      }

      public static function getUpdateMessageForm($message)
      {
          return [
              "options" => [
                  "method"=>"POST",
                  "action"=> BASE_URL."admin/messages/doUpdate/".$message,
                  "id"=>"admin_register_message",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Update Message"
              ],
              "struct" => [

                  "content" => ["label"=>"The content of your message","type"=>"textarea", "placeholder"=>"content of your message", "required"=>0, "error_msg"=>"" ],
                  "thread" => ["label" => "Choose your thread", "type" => "selected", "name" => "listofThread", "value"=>"", "id" => "", "placeholder" => "name of your thread", "required" => 0, "error_msg" => "threadChoose"]

              ]
          ];
      }

     // public static function PostThreadUserForm(){}


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

                "type" =>["label" => "Choose type", "type" => "select", "name" => "type", "id" => "", "placeholder" => "type", "value" => [["name" => "page", "value" => "page"], ["name" => "article", "value" => "article"], ["name" => "news", "value" => "news"]], "required" => 0],

                "category" => ["label" => "The category", "type" => "select", "name" => "", "id" => "", "placeholder" => "", "required" => 0],

                "status" => ["label" => "Choose status", "type" => "select", "name" => "status", "id" => "add_status", "placeholder" => "status", "value" => [["name" => "Rejected", "value" => "-1"], ["name" => "Pending", "value" => "0"], ["name" => "Validated", "value" => "1"]] ,"required" => 0, "msgerror" => ""],

                "content" => ["label" => "The content", "type" => "textarea", "id" => "content_add_article", "placeholder" => "Description of your article", "required" => 0, "errors_msg" => ""],
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
                  "title"=>["label"=>"The title : ", "type"=>"text", "placeholder"=>"Title", "required"=>"required" ],

                  "category"=>[ "label"=>"The Category : ", "type"=>"select", "placeholder"=>"Category", "required"=>"required" ],

                  "status" => ["label" => "Choose status", "type" => "select", "name" => "status", "id" => "add_status", "placeholder" => "status", "value" => [["name" => "Rejected", "value" => "-1"], ["name" => "Pending", "value" => "0"], ["name" => "Validated", "value" => "1"]] ,"required" => 0, "msgerror" => ""],

                  "content"=>[ "label"=>"The content : ", "type"=>"textarea", "placeholder"=>"Content", "required"=>"required" ],
              ]
          ];
      }

      public static function PostTopicAdminForm($content)
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
                  "action"=>BASE_URL."admin/contents/doUpdate/".$content,
                  "id"=>"admin_register_content",
                  "enctype"=>"multipart/form-data",
                  "submit"=>"Update Content"
              ],
              "struct" => [
                  "status"=>["label"=>"The status : ", "type"=>"text", "placeholder"=>"Firstname", "required"=>"required" ],

                  "title"=>["label"=>"The title : ", "type"=>"text", "placeholder"=>"Title", "required"=>"required" ],

                  "category"=>[ "label"=>"The Category : ", "type"=>"select", "placeholder"=>"Category", "required"=>"required" ],

                  "content"=>[ "label"=>"The content : ", "type"=>"textarea", "placeholder"=>"Content", "required"=>"required" ],
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

          "user_newsletters"=>["label"=>"Newsletters", "type"=>"radio", "value"=>["Dont subscribe"=>0, "Subscribe"=>1], "checked"=>0 ],

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

          "user_newsletters"=>["label"=>"Newsletters", "type"=>"radio", "value"=>["Dont subscribe"=>0, "Subscribe"=>1], "checked"=>0 ],

          "user_status"=>["label"=>"Status of the user : ", "type"=>"radio", "required"=>"required", "value"=>["Pending"=>0, "Rejected"=>-1, "Validated"=>1] ],

          "user_img"=>[ "label"=>"Choose The avatar : ", "type"=>"file", "required"=>"required", "msgerror"=>"" ],
        ]
      ];
    }


    public static function getAddCategoryForm()
    {
      return [
          "options" => [
              "method" => "POST",
              "action" => BASE_URL."admin/categories/doAdd/",
              "id" => "admin_register_category",
              "enctype" => "multipart/form-data",
              "submit" => "Add Category"
          ],
          "struct" => [

              "name" => ["label" => "Name here", "type" => "text", "name" => "contentName", "required" => "required", "placeholder" => "Insert your name here"],

              "description" => ["label" => "The description", "type" => "text", "id" => "category_add_article", "placeholder" => "Description of your category", "required" => 0, "errors_msg" => ""]
          ]
      ];
    }


    public static function getUpdateCategoryForm($category)
    {
      return [
          "options" => [
              "method"=>"POST",
              "action"=>BASE_URL."admin/categories/doUpdate/".$category,
              "id"=>"admin_register_category",
              "enctype"=>"multipart/form-data",
              "submit"=>"Update category"
          ],
          "struct" => [
              "name"=>["label"=>"The name : ", "type"=>"text", "placeholder"=>"name", "required"=>"required" ],

              "description"=>["label"=>"The description : ", "type"=>"text", "placeholder"=>"description", "required"=>"required" ],
          ]
      ];
    }


    public static function getAddCommentForm()
    {
      return [
          "options" => [
              "method" => "POST",
              "action" => BASE_URL."admin/comments/doAdd/",
              "id" => "admin_register_comment",
              "enctype" => "multipart/form-data",
              "submit" => "Add comment"
          ],
          "struct" => [
              "content" => ["label" => "The content", "type" => "textarea", "id" => "comment_add_article", "placeholder" => "comment of your content", "required" => 0, "errors_msg" => ""]
          ]
      ];
    }

    public static function getUpdateCommentForm($comment)
    {
      return [
          "options" => [
              "method"=>"POST",
              "action"=>BASE_URL."admin/comments/doUpdate/".$comment,
              "id"=>"admin_register_comment",
              "enctype"=>"multipart/form-data",
              "submit"=>"Update comment"
          ],
          "struct" => [
              "content"=>["label"=>"The Content : ", "type"=>"textarea", "placeholder"=>"content", "required"=>"required" ]
          ]
      ];
    }

    public static function getAddMultimediasForm()
    {
        return [
            "options" => [
                "method" => "POST",
                "action" => BASE_URL."admin/medias/doAdd",
                "id" => "admin_insert_multimedias",
                "enctype" => "multipart/form-data",
                "submit" => "Add multimedias"
            ],
            "struct" => [
                "filename"=>["label"=>"The filename : ", "type"=>"text", "placeholder"=>"filename", "required"=>"required" ],

                "file"=>[ "label"=>"Choose The multimedia : ", "type"=>"file", "required"=>"required" ],
            ]
        ];
    }

    public static function getNewslettersForm()
    {
        return [
            "options" => [
                "method" => "POST",
                "action" => BASE_URL."admin/users/doSendNewsletters",
                "id" => "admin_newsletters",
                "enctype" => "multipart/form-data",
                "submit" => "Send Newsletters"
            ],
            "struct" => [

                "title" => ["label" => "Title here", "type" => "text", "name" => "contentTitle", "required" => "required", "placeholder" => "Insert your title here"],

                "content" => ["label" => "The content", "type" => "textarea", "id" => "content_newsletters", "placeholder" => "Your newsletters", "required" => "required", "errors_msg" => ""],
            ]
        ];
    }

  }
