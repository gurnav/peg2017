<?php

  namespace Core\View;

use Core\Util\Helpers;

  /**
   * Class which render views and template
   */
  class View
  {
      private $view; // The view call
    private $template; // The template call
    private $data = []; // The Data to pass to the view

    /**
     * The constructor of our View class which setup the view and the template
     */
    public function __construct($view = 'index', $template = 'frontend')
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    /**
     * The setter of our view which verify its existance
     * and setup the view
     */
    public function setView($setView)
    {
        if (file_exists('app/Views/'.$setView.'.view.php')) {
            $this->view = $setView;
        } else {
            Helpers::log("La vue :".$setView." n'existe pas.");
            die("La vue n'existe pas !");
        }
    }

    /**
     * The setter of our template which verify its existance
     * and setup the template
     */
    public function setTemplate($setTemp)
    {
        if (file_exists("template/".$setTemp.".temp.php")) {
            $this->template = $setTemp;
        } else {
            Helpers::log("Le template : ".$setTemp." n'existe pas.");
            die("Le template n'existe pas !");
        }
    }

    /**
     * The setter of our View class which verify its existance
     * and setup the view
     */
    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * The destructor of our View class which pass variable to view
     * and include the template
     */
    public function __destruct()
    {
        extract($this->data);
        include 'template/'.$this->template.'.temp.php';
    }
  }
