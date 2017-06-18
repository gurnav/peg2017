<?php

  namespace Core\Views;

  use Core\Util\Helpers;
  use \App;

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
     * @return Void
     */
    public function __construct($view = 'index', $template = 'frontend')
    {
        $this->setView($view);
        $this->setTemplate($template);
        // $this->assign('helpers', Helpers);
    }

    /**
     * TODO Refactor so it can adapt to the route
     * The setter of our view which verify its existance
     * and setup the view
     * @return Void
     */
    public function setView($setView)
    {
        if (file_exists('app'.DS.App::$prefix.DS.'views'.DS.$setView.'.view.php')) {
            $this->view = $setView;
        } else {
            Helpers::log("The view ".$setView."doesn't exist !");
            throw new \Exception("The view ".$setView."doesn't exist !");

        }
    }

    /**
     * The setter of our template which verify its existance
     * and setup the template
     * @return Void
     */
    public function setTemplate($setTemp)
    {
        if (file_exists("template/".$setTemp.".temp.php")) {
            $this->template = $setTemp;
        } else {
            Helpers::log("Le template : ".$setTemp." n'existe pas.");
            throw new Exception("The request template : ".$setTemp." doesn't exist !");
        }
    }

    /**
     * The setter of our View class which verify its existance
     * and setup the view
     * @return Void
     */
    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * The destructor of our View class which pass variable to view
     * and include the template
     * @return Void
     */
    public function __destruct()
    {
        extract($this->data);
        include 'template/'.$this->template.'.temp.php';
    }
  }
