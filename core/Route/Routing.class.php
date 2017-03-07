<?php

  namespace Core\Route;

  /**
   * Class that manage the CRUD Routing
   */
  class Routing {

    private $uri; // The uri called
    private $uriExploded; // The exploded uri called

    private $controller; // The controller called
    private $controllerName; // The controller name lowercased
    private $fullControllerName; // The full Controller name with namespace
    private $action; // The action called
    private $actionName; // The action name lowercased
    private $params; // Parameters in the url


    /**
     * The constructor of our routing class which
     * check our url and build it consequently
     */
    public function __construct() {
      $this->setUri($_SERVER["REQUEST_URI"]);
      $this->setController();
      $this->setAction();
      $this->setParams();
      $this->runRoute();
    }

    /**
     * Setup the uri and clean it
     */
    public function setUri($uri) {
      $uri = preg_replace("#".PATH_RELATIVE_PATTERN."#i", "", $uri, 1);
      $this->uri = trim($uri, "/");
      $this->uriExploded = explode("/", $this->uri);
    }

    /**
     * Setup the controller whether it exist or not
     */
    public function setController() {
      $this->controller = (empty($this->uriExploded[0]))?"Index":ucfirst($this->uriExploded[0]) ;
  		$this->controllerName = $this->controller."Controller";
      $this->fullControllerName = "App\\Controller\\".$this->controllerName;
  		unset($this->uriExploded[0]);
    }

    /**
     * Setup the action whether it exist or not
     */
    public function setAction() {
      $this->action = (empty($this->uriExploded[1]))?"index":$this->uriExploded[1];
      $this->actionName = $this->action."Action";
      unset($this->uriExploded[1]);
    }

    /**
     * Setup the paramater whether it exist or not
     */
    public function setParams() {
      $this->params = array_merge(array_values($this->uriExploded), $_POST);
    }

    /**
     * Check if the route exist in the application or not
     */
    public function checkRoute() {
      $isRoute = false;
      $controllerPath = "app".DS."Controller".DS.$this->controllerName.".class.php";
      if( file_exists($controllerPath) ) {
        include $controllerPath;
        if( class_exists($this->fullControllerName) ) {
          if( method_exists($this->fullControllerName, $this->actionName) ) {
            $isRoute = true;
          }
        }
      }
      return $isRoute;
    }

    /**
     * Execute the route if it exist
     */
    public function runRoute() {
      if( $this->checkRoute() ) {
        $controller = new $this->fullControllerName;
        $controller->{$this->actionName}($this->params);
      } else {
        $this->notFound();
      }
    }

    /**
    * Send a Forbiden page
    */
    protected function forbidden() {
      header('HTTP/1.0 403 Forbidden');
      die('Acces not allowed');
    }

    /**
    * Send a notFound page
    */
    protected function notFound() {
      header('HTTP/1.0 404 Not Found');
      die('Page not found');
    }

  }
