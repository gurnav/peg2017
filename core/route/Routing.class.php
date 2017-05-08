<?php

  namespace Core\Route;

  use \App;
  use Core\Util\Helpers;

  /**
   * Class that manage the CRUD Routing
   * For EVERY Route
   */
  class Routing
  {
    private $uri; // The uri called
    private $uriExploded; // The exploded uri called
    private $prefix; // The prefix called
    private $controller; // The controller called
    private $controllerName; // The controller name lowercased
    private $fullControllerName; // The full Controller name with namespace
    private $action; // The action called
    private $actionName; // The action name lowercased
    private $params; // Parameters in the url

    /**
     * The constructor of our routing class which
     * check our url and build it consequently
     * @return void
     */
    public function __construct()
    {
        $this->setUri($_SERVER["REQUEST_URI"]);
        $this->setPrefix();
        $this->setController();
        $this->setAction();
        $this->setParams();
        $this->runRoute();
    }

    /**
     * Setup the uri and explode it
     * @param $uri : String The URi to be set
     * @return void
     */
    public function setUri($uri)
    {
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        $uri = preg_replace("#".PATH_RELATIVE_PATTERN."/#", "", $uri, 1);
        // TODO: filter_var($uri, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED);
        $this->uri = trim($uri, DS);
        $this->uriExploded = explode('/', $this->uri);
    }

    /**
     * Setup the prefix whatever it exist or not
     * @return void
     */
    public function setPrefix()
    {
      if($this->uriExploded[0] !== 'admin') {
          array_unshift($this->uriExploded, 'front');
      }

      $this->prefix = $this->uriExploded[0];

      App::setPrefix($this->prefix);
      unset($this->uriExploded[0]);
    }

    /**
     * Setup the controller whether it exist or not
     * @return void
     */
    public function setController()
    {
        $this->controller = (empty($this->uriExploded[1]))?"Index":ucfirst($this->uriExploded[1]);
        $this->controllerName = $this->controller."Controller";
        $this->fullControllerName = "App\\".ucfirst($this->prefix)."\\Controllers\\".$this->controllerName;
        unset($this->uriExploded[1]);
    }

    /**
     * Setup the action whether it exist or not
     * @return void
     */
    public function setAction()
    {
        $this->action = (empty($this->uriExploded[2]))?"index":$this->uriExploded[2];
        $this->actionName = $this->action."Action";
        unset($this->uriExploded[2]);
    }

    /**
     * Setup the paramater whether it exist or not
     * @return void
     */
    public function setParams()
    {
        $this->params = array_merge(array_values($this->uriExploded), $_POST);
    }

    /**
     * Check if the route exist in the application or not
     * @return $isRoute : Boolean if the route is valid / exist or not
     */
    public function checkRoute()
    {
        $isRoute = false;
        $controllerPath = "app".DS.$this->prefix.DS."controllers".DS.$this->controllerName.".class.php";
        if (file_exists($controllerPath)) {
            include $controllerPath;
            if (class_exists($this->fullControllerName)) {
                if (method_exists($this->fullControllerName, $this->actionName)) {
                    $isRoute = true;
                }
            }
        }
        return $isRoute;
    }

    /**
     * Execute the route if it exist
     * @return void
     */
    public function runRoute()
    {
        if ($this->checkRoute()) {
            $controller = new $this->fullControllerName;
            $controller->{$this->actionName}($this->params);
        } else {
            self::notFound();
        }
    }

    /**
    * Send a Forbiden page
    * @return void
    */
    public static function forbidden()
    {
        header('HTTP/1.1 403 Forbidden');
        die('Acces not allowed');
    }

    /**
    * Send a notFound page
    * @return void
    */
    public static function notFound()
    {
        header('HTTP/1.1 404 Not Found');
        echo 'Page not found';
    }
  }
