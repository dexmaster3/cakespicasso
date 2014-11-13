<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
define('ROOT', dirname(__FILE__));
define('HOSTROOT', $_SERVER['SERVER_NAME']);

if ($_SERVER['REQUEST_URI'] == "/favicon.ico") {
    header("Content-Type: image/x-icon");
    readfile(ROOT . '/favicon.ico');
    die("Prevent favicon requests");
}

require 'lib/bootstrap.php';