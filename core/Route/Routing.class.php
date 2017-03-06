<?php

  namespace Core\Route;

  class Routing {

    private $uri;
    private $uriExploded;

    private $controller;
    private $controllerName;
    private $fullControllerName;
    private $action;
    private $actionName;
    private $params;

    public function __construct() {
      $this->setUri($_SERVER["REQUEST_URI"]);
      $this->setController();
      $this->setAction();
      $this->setParams();
      $this->runRoute();
    }

    public function setUri($uri) {
      $uri = preg_replace("#".PATH_RELATIVE_PATTERN."#i", "", $uri, 1);
      $this->uri = trim($uri, "/");
      $this->uriExploded = explode("/", $this->uri);
    }

    public function setController() {
      $this->controller = (empty($this->uriExploded[0]))?"Index":ucfirst($this->uriExploded[0]) ;
  		$this->controllerName = $this->controller."Controller";
      $this->fullControllerName = "App\\Controller\\".$this->controllerName;
  		unset($this->uriExploded[0]);
    }

    public function setAction() {
      $this->action = (empty($this->uriExploded[1]))?"index":$this->uriExploded[1];
      $this->actionName = $this->action."Action";
      unset($this->uriExploded[1]);
    }

    public function setParams() {
      $this->params = array_merge(array_values($this->uriExploded), $_POST);
    }

    public function checkRoute() {
      // On part du principe que la route est fausse
      $isRoute = false;
      $controllerPath = "app".DS."Controller".DS.$this->controllerName.".class.php";
      // Le fichier existe ?
      if( file_exists($controllerPath) ) {
        include $controllerPath;
        // Peut on creer un objet a partir de ce fichier ?
        if( class_exists($this->fullControllerName) ) {
          // L'objet contient il la méthod ?
          if( method_exists($this->fullControllerName, $this->actionName) ) {
            $isRoute = true;
          }
        }
      }
      // Si existe return True sinon False
      return $isRoute;
    }

    public function runRoute() {
      if( $this->checkRoute() ) {
        $controller = new $this->fullControllerName;
        $controller->{$this->actionName}($this->params);
      } else {
        $this->notFound();
      }
    }

    protected function forbidden() {
      header('HTTP/1.0 403 Forbidden');
      die('Acces interdit');
    }

    protected function notFound() {
      header('HTTP/1.0 404 Not Found');
      die('Page introuvable');
    }

  }
