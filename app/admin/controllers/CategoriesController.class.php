<?php

  namespace App\Admin\Controllers;

  use Core\Controllers\Controller;
  use Core\Views\View;
  use Core\Util\Helpers;
  use App\Admin\Models\Categories;
  use App\Composite\Factories\ModalsFactory;
  use App\Admin\Models\Users;

  class CategoriesController extends Controller
  {

    public function indexAction()
    {
        $v = new View('categories/categories');
        $categories = Categories::getAll();

        $v->assign('categories', $categories);

        if(!empty($SESSION['errors'])) {
            $v->assign('errors', $errors);
            unset($_SESSION['errors']);
        }
    }

    public function addAction()
    {
      $v = new View('categories/add_category');

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
      print_r($_POST);
      foreach ($_POST as $post => $value) {
          $cleanedData[$post] = Helpers::cleanString($value);
      }

      try {
          $category->setName($cleanedData['name']);
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
          $category->setDescription($cleanedData['description']);
      } catch (\Exception $e) {
          array_push($_SESSION['errors'], $e->getMessage());
      }

      try {
          $category->setUsers_id(intval(Users::getIdByUsername("admin")));
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
          $_SESSION['addCategory']['name'] = $cleanedData['name'];
          $_SESSION['addCategory']['description'] = $cleanedData['description'];
          header('Location: '.BASE_URL.'admin/categories/add');
      }
    }
  }
