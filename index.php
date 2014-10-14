<?php

define('ROOT', dirname(__FILE__));

if ($_SERVER['REQUEST_URI'] == "/favicon.ico") {
    $img = file('./favicon.ico');
    header("Content-Type: image/x-icon");
    die;
}

require 'lib/bootstrap.php';

echo "<h1>Server</h1>";
var_dump($_SERVER);
echo "<h1>Get</h1>";
var_dump($_GET);
echo "<h1>Post</h1>";
var_dump($_POST);
echo "<h1>Request</h1>";
var_dump($_REQUEST);