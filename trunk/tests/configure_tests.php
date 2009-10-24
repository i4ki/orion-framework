<?php

define("TESTS_PATH", dirname(__FILE__));
define("ORION_PATH", TESTS_PATH . '/project_test/libs/Vendor/Orion');
define("SEP", DIRECTORY_SEPARATOR);
define("LN", PHP_SAPI == 'cli' ? "\n" : "<br>");
error_reporting(E_ALL & ~E_DEPRECATED);
set_include_path('/mnt/www/SimpleTest' . PATH_SEPARATOR . get_include_path());
require_once("autorun.php");

require_once(ORION_PATH . SEP . "Orion.php");
