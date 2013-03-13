<?php
//The main bootstrap file to define paths and to include the master file.
//@author - Raghunath J
//@path - /boot.inc.php
//version 1.0

define('SITE_ROOT',dirname(__FILE__));

//This will link to software folder, if in case you wan't to rename the software folder to
//something else like 'engine' then make sure you have changed it here. Else you will see errors
define('SOFTWARE','software');

//The current squirrel UI theme. By default its 'default', you can create your own theming and
//change the theme name here
define('THEME','default');

//All server details defined.
define('REQUEST_URI',$_SERVER['REQUEST_URI']);
define('SCRIPT_NAME',$_SERVER['SCRIPT_NAME']);
define('SERVER_NAME',$_SERVER['SERVER_NAME']);

//The enviroment configuration. By default in 'production', but if
//you are expanding the app or testing your custom libraries then change it to 'development'.
define('ENV','development');

define('EXT','.class.php');

//Include our master file from software folder
include_once(SITE_ROOT.'/'.SOFTWARE.'/master.inc.php');