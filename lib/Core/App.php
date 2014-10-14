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
        $dispatcher->setRouteController(); //Use magic setters/getters here
        $dispatcher->setActionView();
        $dispatcher->launchView();

        Core_Database::connect(array('localhost', 'cakespicasso', 'dexter', 'dexter'));

        $stuff = new Cake_Model_ControllerViews();
        $crag = $stuff->get('controller_views');
        echo $crag;

        echo var_dump($request);
    }
}