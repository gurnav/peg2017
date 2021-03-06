<?php

  namespace Core\Controllers;

  use Core\Views\View;

  /**
   * Class that is the base of all our controllers
   * Allow multiple actions on controllers
   */
  class Controller
  {

    /**
     * Function that render multiple variable in the view
     * @param $view : View the view where the variable are passed
     * @param $variable : Array The associative array whit the variable and their values
     * @return void
     */
    protected function render(View $view, $variables = [])
    {
        foreach ($variables as $key => $value) {
            $view->assign($key, $value);
        }
    }
  }
