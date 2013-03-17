<?php
//The Core COntroller class file, this gets extened to all controller files in application
//@author - Raghunath J
//@path - /core/Corecontroller.class.php
//version 1.0
abstract class Corecontroller{

	function __construct(){

	}

	//To display a view with/without data
	public function view($view,$data = null){
		$view_path = SITE_ROOT.'/application/views/'.$view.'.php';
		//Check if file is present
		if(file_exists($view_path)){
			//Check if the data is not null.
			//If its not null then extract the data to its own variables.
			//More info about extract: http://php.net/manual/en/function.extract.php
			if($data!=null){
				extract($data);
			}
			include $view_path;
		}else{
			//Include 404 page inside.
			include SITE_ROOT.'/application/error/404.php';
		}
		return '';
	}

}