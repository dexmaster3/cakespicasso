<?php

class Core_App
{
    public function run()
    {
        $configuration = Core_Config::getConfig();
        $request = Core_Request::getRequest();
        $test = Core_Router::getRequestPath();
        echo var_dump($request);
    }
}