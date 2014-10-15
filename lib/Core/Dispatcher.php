<?php

class Core_Dispatcher
{
    private $route;
    private $controller;

    public function setRouteController()
    {
        $this->route = Core_Router::getRoute();

        if (class_exists($controller_loc = $this->route['module'] . '_Controller_' . $this->route['controller'])) {
            $controller = new $controller_loc;
            $this->controller = $controller;
        }
        else {
            echo 'Module->Controller not found';
            throw new Exception('Module->Controller not found');
        }
    }
    public function setActionView()
    {
        $action = $this->route['action'];
        if (method_exists($this->controller, $action) && is_callable(array($this->controller, $action))) {
            $this->controller->setView($action);
        }
        else {
            echo 'Module->Controller->action not found';
            throw new Exception('Module->Controller->action not found');
        }
    }

    public function launchView()
    {
        $action = $this->route['action'];
        return $this->controller->$action(Core_Request::getRequest()->parsed_query);
    }
}