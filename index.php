<?php

define('ROOT', dirname(__FILE__));

if ($_SERVER['REQUEST_URI'] == "/favicon.ico") {
    $img = file('./favicon.ico');
    header("Content-Type: image/x-icon");
    die("Prevent favicon requests");
}

require 'lib/bootstrap.php';