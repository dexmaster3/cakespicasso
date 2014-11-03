<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
define('ROOT', dirname(__FILE__));

if ($_SERVER['REQUEST_URI'] == "/favicon.ico") {
    $img = file(ROOT . '/favicon.ico');
    header("Content-Type: image/x-icon");
    die("Prevent favicon requests");
}

require 'lib/bootstrap.php';