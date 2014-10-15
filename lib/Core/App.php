<?php

class Core_App
{
    public function run()
    {
        //Set Config/Request/Router for this http request
        Core_Config::getConfig();
        Core_Request::getRequest();
        Core_Router::getRoute();

        //Seed Database?
//        $custom_routes = new Core_Model_CustomRoutes();
//        $custom_routes->createTable();

        //Grab relevant deployment
        $dispatcher = new Core_Dispatcher();
        $dispatcher->setRouteController(); //Use magic setters/getters here
        $dispatcher->setActionView();
        echo $dispatcher->launchView();
    }
}