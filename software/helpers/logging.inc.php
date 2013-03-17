<?php
//The Log Class
//@author - Raghunath J
//@path - /software/helpers/logging.inc.php
//version 1.0

define('LOG_FILE','');
define('LOG_MODE','');
define('LOG_MODE_DEBUG','debug');
define('LOG_MODE_WARNING','warning');
define('LOG_MODE_ERROR','error');

function console_log($message) {
    error_log($message, 3, get_option(LOG_FILE));
}