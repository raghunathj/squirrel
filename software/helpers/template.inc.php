<?php
//All the templating and config calling code is added here
//@author - Raghunath J
//Version 1.0
//@path - /software/helpers/templating.inc.php

//Get squirrel config options
function get_option($name) {
	global $sq_options;
	return $sq_options[$name];
}