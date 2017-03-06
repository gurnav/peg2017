<?php

  namespace Core\Controller;

  use Core\View\View;

  class Controller {

    protected function render(View $view, $variables = []) {
      foreach ($variables as $key => $value) {
        $view->assign($key, $value);
      }
    }

}
