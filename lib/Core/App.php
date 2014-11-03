<?php

class Core_App
{
    protected $app_config;
    protected $app_request;
    protected $app_router;

    protected $data;

    public function run()
    {
        //Best to set the session before anything else
        session_start();

        //Set Config/Request/Router for this http request
        $this->app_config = Core_Config::getConfig();

        if (class_exists("DB_Model_Seed")) {
            $database = new DB_Model_Seed();
            $database->initializeDatabase();
        }

        $this->app_request = Core_Request::getRequest();
        $this->app_router = Core_Router::getRoute();


        //Grab relevant deployment
        $dispatcher = new Core_Dispatcher();
        echo $dispatcher->completeRequest();
    }
}