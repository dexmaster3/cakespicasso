<?php

class Core_Dispatcher
{
    public function launchView()
    {
        $route = Core_Router::getRoute();
        $controller = $this->createRequestedController($route);
        $this->setViewForRequest($route, $controller);

        $action = $route['action'];
        return $controller->$action($route['params']);
    }

    public function createRequestedController($route)
    {
        if (class_exists($controller_loc = $route['module'] . '_Controller_' . $route['controller'])) {
            $controller = new $controller_loc;
            return $controller;
        } else {
            echo 'Module->Controller not found';
            return new Exception('Module->Controller not found');
        }
    }
    public function setViewForRequest($route, $controller)
    {
        $action = $route['action'];
        if (method_exists($controller, $action) && is_callable(array($controller, $action))) {
            $controller->setView($action);
        }
        else {
            echo 'Module->Controller->action not found';
            return new Exception('Module->Controller->action not found');
        }
    }
}