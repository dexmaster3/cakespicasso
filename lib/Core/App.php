<?php

class Core_App
{
    public function run()
    {
        //Set Config/Request/Router for this http request
        Core_Config::getConfig();
        Core_Request::getRequest();
        Core_Router::getRoute();

        //Grab relevant deployment
        $dispatcher = new Core_Dispatcher();
        $dispatcher->setRouteController(); //Use magic setters/getters here
        $dispatcher->setActionView();
        $dispatcher->launchView();
/*
        $stuff = new Cake_Model_ViewAssociations();
        $crag = $stuff->findAllByColumnValue('module', 'Cake');
        $stuff->dropTable();
        $stuff->createTable();
        $stuff->addRow(array( 'module' => 'moddy','view' => 'viewz', 'action' => 'fun'));*/
    }
}