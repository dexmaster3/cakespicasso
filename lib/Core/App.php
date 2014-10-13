<?php

class Core_App
{
    public function run()
    {
        //Set Config/Request/Router for this http request
        $configs = Core_Config::getConfig();
        $request = Core_Request::getRequest();
        $location = Core_Router::getRoute();

        //Grab relevant deployment
        $dispatcher = new Core_Dispatcher();
        $dispatcher->setRouteController();
        $dispatcher->setActionView();
        $dispatcher->launchView();

        Core_Database::connect(array('localhost', 'cakespicasso', 'dexter', 'dexter'));

        echo var_dump($request);
    }
}