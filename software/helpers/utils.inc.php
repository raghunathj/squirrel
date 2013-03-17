<?php
//The Utility file to perform small operations and also a repeative one.
//@author - Raghunath J
//@path - /software/helpers/util.inc.php
//version 1.0


//Check and get parameter if present in a URL
function get_parameter($parm){
	$return = "";
    if (isset($_REQUEST[$parm])) {
        $return = $_REQUEST[$parm];
    }
    return $return;
}

//Redirect to a URL
function redirect($url){
	$hostName = $_SERVER['HTTP_HOST'];
    header("Location: http://" . $hostName . $url);
    die();
}

//Check ends_with character
function ends_with($str, $sub) {
    return (substr($str, strlen($str) - strlen($sub)) == $sub);
}

//Get IP address
function getip(){
	$iptemp = $_SERVER['REMOTE_ADDR'];
	return $iptemp;
}