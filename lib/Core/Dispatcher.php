<?php

class Core_Dispatcher
{
    public function getView()
    {
        $route = Core_Router::getRoute();
        $controller = $this->createRequestedController($route);
        $this->setViewForRequest($route, $controller);

        $action = $route['action'];
        $result = $controller->$action($route['params']);
        if ($result[0]) {
            $this->data = $result[2];
            include $result[1];
        }
        else {
            echo html_entity_decode($result[1]);
        }
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