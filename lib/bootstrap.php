<?php

require "Core/Autoloader.php";

$loader = new Core_Autoloader();
$loader->register(array(
    'app',
    'lib'
));

$app = new Core_App();
$app->run();