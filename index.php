<?php
/* Main file
@author - Raghunath J */
include('boot.inc.php');
$instance;

//Get the route parameter from the url
$req_uri = get_parameter("route");

//Initialise router class
$router = new Router();

//Check if the user is overwriting the route from application/routes.inc.php
$new_uri = $router->replace($req_uri,$routes);

if($new_uri != ''){
	$req_uri = $new_uri;
}

//Parse the route to fetch controllers, methods and its arguments
$route = $router->parse($req_uri);
$controller = $route->controller;
$method = $route->method;
$subdir = $route->subdir;
$arguments = $route->arguments;

//Now we need to check if the controller is present in a subdirectory fo controller folder and load the class
if($subdir == ''){
	$class_path = SITE_ROOT.'/application/controllers/'.$controller.'.php';
}else{
	$class_path = SITE_ROOT.'/application/controllers/'.$subdir.'/'.$controller.'.php'; 
}

if(file_exists($class_path)){
	require_once($class_path);
	if(class_exists($controller)){
		$instance = new $controller;
	}else{
		console_log("Class $controller: Does not exist.");
		die('Class $controller: not loaded');
	}

}