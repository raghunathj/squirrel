<?php
//The Router class file. Supports the application routes file
//@author - Raghunath J
//@path - /core/Router.class.php
//version 1.0
class Router{
	var $routes = array();
	
	function __construct($auth = false){
		$this->auth = $auth;
	}

	//This code identifies
	function parse($uri){
		//Remove the last trailing '/'
		if(ends_with($uri,'/')){
			$uri = substr($uri,0,-1);
		}
		$subdir = '';
		$method = '';
		$segments = explode('/',$uri);
		$controller = $segments[0]; //The first segment will always be a controller
		$controller_path = 'application/controllers/'.$controller.'.php';

		//Check if the controller is a default one or not
		if($controller != '' && file_exists($controller_path)){
			$class = $controller;
			$segments = array_slice($segments,1);
		}else{
			$class = 'welcome';
		}

		//Try to retrive method
		$controller = $class;
		if(count($segments) > 0){
			$method = $segments[0];
			if(method_exists($controller, $method) == false){
				$method = 'index';
			}else{
				$segments = array_slice($segments, 1);
			}
		}else{
			$method = 'index';
			$segments = array();
		}

		return new Route($controller,$method,$segments);
	}

	function replace($req_uri, $routes) {
		if(isset($routes[$req_uri])){
			return $routes[$req_uri];
		}
		return '';
    }

    
}

class Route{
	var $subdir;
    var $controller;
    var $method;
    var $arguments;

    function __construct($controller, $method, $arguments) {
        $this->controller = $controller;
        $this->method = $method;
        $this->arguments = $arguments;
    }
}