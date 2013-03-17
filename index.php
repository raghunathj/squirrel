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

//Load the class file from controllers folder
if(file_exists($class_path)){
	require_once($class_path);
	if(class_exists($controller)){
		$instance = new $controller;
	}else{
		console_log("Class $controller: Does not exist.");
		die('Class $controller: not loaded');
	}
}else{
    die('[' . $class_path . '] DOES NOT EXIST');
}

//Load the method from the above loaded class
if(method_exists($controller, $method)){
	call_user_func_array(array($instance, $method), $arguments);
}else{
	//If the method is not present check if index method is present, yes - load it else, throw error
	if(method_exists($controller,'index')){
		call_user_func_array(array($instance, 'index'), $arguments);
	}else{
		die('[' . $controller . '->' . $method . '] DOES NOT EXIST	');
	}
}