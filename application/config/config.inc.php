<?php
//The Application Configuration file.
//@author - Raghunath J
//@path - /application/config/config.inc.php
//version 1.0
//Notes - User has to change the url path etc

//Set session var
define('SESSION_VAR','session_var');

$appsettings = array();
$routes = array();

//Default Site/Squirrel URL. Make sure a '/' ends in the url
$appsettings['siteurl'] = 'http://localhost/squirrel/';

//If you are url-rewriting the site then remove index.php,
//Make sure mod_rewrite is turned on
$appsettings['index'] = 'index.php';

//Error Log storage path
$appsettings['log'] = SITE_ROOT.'/application/logs/error.log';

//Include the main database. Well as default squirrel needs database to run, so i don't need to
//call database if its required or not

include_once('database.inc.php');

//Include our default routes file
include_once('routes.inc.php');

//Our main functions file
include_once('helpers/functions.inc.php');