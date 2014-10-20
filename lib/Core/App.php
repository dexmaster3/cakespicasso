<?php

class Core_App
{
    protected $app_config;
    protected $app_request;
    protected $app_router;

    protected $data;

    public function run()
    {
        //Set Config/Request/Router for this http request
        $this->app_config = Core_Config::getConfig();
        $this->app_request = Core_Request::getRequest();
        $this->app_router = Core_Router::getRoute();

        //Grab relevant deployment
        $dispatcher = new Core_Dispatcher();
        $dispatcher->getView();
    }
}