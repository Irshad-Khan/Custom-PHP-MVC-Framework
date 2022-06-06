<?php

/**
 * we want to get App Root upto parent
 * This line give us C:\wamp64\www\traversymvc\app\config\config.php
 * echo __FILE__;
 * dirname() function return follwoling output
 * C:\wamp64\www\traversymvc\app\config but we need to remove config also 
 * rape it again dirname()
 * Now we can Access APP_ROOT in any file
 */
define('APP_ROOT',dirname(dirname(__FILE__)));

/**
 * URL Root
 */
define('BASE_URL', '_YOUR_URL_');

/**
 * Site Name
 */
define('SITE_NAME', '_YOUR_SITENAME');

// DB Params
define('DB_HOST', '_YOUR_HOST_');
define('DB_Usser', '_YOUR_USER_');
define('DB_PASSWORD', '_YOUR_PASSWORD_');
define('DB_NAME', '_YOUR_DB_');
