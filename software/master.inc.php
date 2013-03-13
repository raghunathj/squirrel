<?php
//The master file to include everything required to run squirrel.
//@author - Raghunath J
//@path - /software/master.inc.php
//version 1.0
//Notes - Please don't modify anything until unless you have knowledge on what you are doing
if (version_compare(phpversion(), '5.1.0', '<') == true) { die ('Squirrel supports PHP5.1 Or Greater Only.'); }
//Make sure the session is started
session_start();

//Error report will be turned of when squirrel is in production mode. 
//To change the environment you can find it a boot.inc.php present in the root folder.
if(ENV == 'production'){
	error_reporting(E_ERROR);
}

header("Cache-control: private");

//Include all the files that are required to make this framework behave as a framework.
include_once(SITE_ROOT.'/'.SOFTWARE.'/helpers/logging.inc.php');
include_once(SITE_ROOT.'/'.SOFTWARE.'/config/config.inc.php');
include_once(SITE_ROOT.'/'.SOFTWARE.'/helpers/utils.inc.php');
include_once(SITE_ROOT.'/'.SOFTWARE.'/helpers/errors.inc.php');
include_once(SITE_ROOT.'/'.SOFTWARE.'/helpers/template.inc.php');
include_once(SITE_ROOT.'/'.SOFTWARE.'/library/adodb5/adodb.inc.php');

//Application level configuration file
include_once(SITE_ROOT."/application/config/config.inc.php"); 

//Enable ADODB Database abstraction library
//more info: http://adodb.sourceforge.net/
$conn=&ADONewConnection($database_type);
$conn->PConnect($database_host,$database_username,$database_password,$database_name);

//Autoload available Class files.
//If there are errors or unable to load a class then break the system

function __autoload($class){
	$loaded = false;
	$ado_class = str_replace('_','-',strtolower($class));
	$library_path = array(
			SITE_ROOT.'/'.SOFTWARE.'/core/'.$class.'.class.php',
			SITE_ROOT.'/'.SOFTWARE.'/components/'.$class.'.class.php',
			SITE_ROOT.'/'.SOFTWARE.'/library/adodb5/'.$class.'.class.php',
			SITE_ROOT.'/'.SOFTWARE.'/application/controllers/'.$class.'.class.php',
			SITE_ROOT.'/'.SOFTWARE.'/application/models/'.$class.'.class.php',
			SITE_ROOT.'/'.SOFTWARE.'/application/classes/'.$class.'.class.php',
			SITE_ROOT.'/'.SOFTWARE.'/application/validators/'.$class.'.class.php'
		);

	//Loop in to auto load all .class.php files present in the above array paths.
	foreach($library_path as $lib){
		if(file_exists($lib)){
			require_once($lib);
			$loaded = true;
			break;
		}
	}

	if($loaded == false){
		console_log("Can't find a file for class: $class  \nPagename: $pageName");
	}

}