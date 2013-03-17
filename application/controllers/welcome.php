<?php
//The Default controller
class welcome extends Corecontroller{

	function __construct() { 
		parent :: __construct(); 
	}

	function index(){
		$data['title'] = 'Home Page';
		echo 'a';
		$this->view('welcome',$data);
	}

}