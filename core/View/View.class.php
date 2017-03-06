<?php

  namespace Core\View;

  use Core\Util\Helpers;

  class View {

    private $view;
    private $template;
    private $data = [];

    public function __construct($view='index', $template='frontend') {
      $this->setView($view);
      $this->setTemplate($template);
    }

    public function setView($setView) {
      if( file_exists('app/Views/'.$setView.'.view.php') ) {
        $this->view = $setView;
      } else {
        Helpers::log("La vue :".$setView." n'existe pas.");
        die("La vue n'existe pas !");
      }
    }

    public function setTemplate($setTemp) {
      if( file_exists("template/".$setTemp.".temp.php") ) {
        $this->template = $setTemp;
      } else {
        Helpers::log("Le template : ".$setTemp." n'existe pas.");
        die("Le template n'existe pas !");
      }
    }

    public function assign($key, $value) {
      $this->data[$key] = $value;
    }

    public function __destruct() {
      extract($this->data);
      include 'template/'.$this->template.'.temp.php';
    }

  }
