<?php

class Core_Dispatcher
{
    private $location;
    private $controller;

    public function setRouteController()
    {
        $this->location = Core_Router::getRoute();

        if (class_exists($controller_loc = $this->location['module'] . '_Controller_' . $this->location['controller'])) {
            $controller = new $controller_loc;
            $this->controller = $controller;
        }
        else {
            throw new Exception('Module->Controller not found');
        }
    }
    public function setActionView()
    {
        $action = $this->location['action'];
        if (method_exists($this->controller, $action) && is_callable(array($this->controller, $action))) {
            $this->controller->setView($action);
        }
        else {
            throw new Exception('Module->Controller->action not found');
        }
    }

    public function launchView()
    {
        $action = $this->location['action'];
        return $this->controller->$action(Core_Request::getRequest()->parsed_query);
    }
}