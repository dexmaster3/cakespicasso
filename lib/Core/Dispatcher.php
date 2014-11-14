<?php

class Core_Dispatcher
{
    public function completeRequest()
    {
        $route = Core_Router::getRoute();
        $action = $route['action'];

        $controller = $this->createRequestedController($route);
        $valid_action = $this->checkValidControllerAction($action, $controller);

        if ($valid_action) {
            //Calling our actual requested controller action
            $result = $controller->$action($route['params']);
            return $result;
        }
    }

    public function createRequestedController($route)
    {
        if (class_exists($controller_loc = $route['module'] . '_Controller_' . $route['controller'])) {
            $controller = new $controller_loc;
            return $controller;
        } else {
            return array(
                "success" => false,
                "message" => "Could not create requested controller"
            );
        }
    }
//ToDo: Switch to 404 pages
    public function checkValidControllerAction($action, $controller)
    {
        if (method_exists($controller, $action) && is_callable(array($controller, $action))) {
            return true;
        } else {
            return array(
                "success" => false,
                "message" => "Could not complete action"
            );
        }
    }
}