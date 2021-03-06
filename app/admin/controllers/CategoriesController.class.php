<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Admin\Models\Categories;
  use App\Composite\Models\User;
  use App\Composite\Factories\ModalsFactory;
  use App\Admin\Models\Users;

  class CategoriesController extends Controller
  {

    public function indexAction($args)
    {
        $v = new View('categories/categories', 'admin');

        if (empty($args)) {
            $pagination = 1;
        } else {
            $pagination = intval($args[0]);
        }

        $offset = ($pagination * 10) - 10;
        $categories = Categories::getAllCategoriesWithUsers(10, $offset);

        $v->assign('count', Categories::getCount()->count);
        $v->assign('categories', $categories);

        if(!empty($_SESSION['errors'])) {
            $v->assign('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }
    }

    public function addAction()
    {
      $v = new View('categories/add_category', 'admin');

      $admin_register_category = ModalsFactory::getAddCategoryForm();
      if(!empty($_SESSION['addCategory'])) {
          $admin_register_category['struct']['name']['value'] = $_SESSION['addCategory']['name'];
          $admin_register_category['struct']['description']['value'] = $_SESSION['addCategory']['description'];
          unset($_SESSION['addCategory']);
      }

      $v->assign('admin_register_category', $admin_register_category);

      if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
          $v->assign('errors', $_SESSION['errors']);
          unset($_SESSION['errors']);
      }
    }


    public function doAddAction()
    {
      $category = new Categories();
      $_SESSION['errors'] = [];

      // foreach ($_POST as $post => $value) {
      //    $_POST[$post] = Helpers::cleanString($value);
      // }

      try {
          $category->setName($_POST['name']);
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
          $category->setDescription($_POST['description']);
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
          $category->setUsers_id(intval($_SESSION["user"]["id"]));
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
          if(empty($_SESSION['errors']))
              $category->save();
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }

      // If no error login and send him / her on the home page
      if(empty($_SESSION['errors']))
      {
          unset($_SESSION['errors']);
          unset($_SESSION['addCategory']);
          header('Location: '.BASE_URL.'admin/categories');
      } else {
          $_SESSION['addCategory']['name'] = $_POST['name'];
          $_SESSION['addCategory']['description'] = $_POST['description'];
          header('Location: '.BASE_URL.'admin/categories/add');
      }
    }

    public function deleteAction($id_category)
    {
      $category = new Categories();
        $id_category = trim($id_category[0]);
      try {
          $category = $category->populate(['id' => $id_category]);
          $category->delete();
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }
      header('Location: '.BASE_URL.'admin/categories');
    }

    public function updateAction($id_category)
    {
      $v = new View('categories/add_category', 'admin');

      $category = new Categories();
      $id_category = $id_category[0];
      $category = $category->populate(['id' => $id_category]);

      $admin_register_category = ModalsFactory::getUpdateCategoryForm($id_category);
      $admin_register_category['struct']['name']['value'] = $category->getName();
      $admin_register_category['struct']['description']['value'] = $category->getDescription();

      $v->assign('admin_register_category', $admin_register_category);

      if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
          $v->assign('errors', $_SESSION['errors']);
          unset($_SESSION['errors']);
      }
    }

      public function doUpdateAction($id_category)
      {
          $category = new Categories();
          $id_category = trim($id_category[0]);
          $_SESSION['errors'] = [];

          // foreach ($_POST as $post => $value) {
          //    $_POST[$post] = Helpers::cleanString($value);
          // }

          try {
              $category = $category->populate(['id' => $id_category]);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $category->setName($_POST['name']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              $category->setDescription($_POST['description']);
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          try {
              if(empty($_SESSION['errors']))
                  $category->save();
          } catch (\Exception $e) {
              array_push($_SESSION['errors'], $e->getMessage());
          }

          // If no error login and send him / her on the home page
          if(empty($_SESSION['errors']))
          {
              unset($_SESSION['errors']);
              header('Location: '.BASE_URL.'admin/categories');
          } else {
              header('Location: '.BASE_URL.'admin/categories/update/'.$category->getId());
          }
      }

  }
