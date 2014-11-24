<?php

class Core_Dispatcher
{
    public function completeRequest()
    {
        $route = Core_Router::getRoute();
        $config = Core_Config::getConfig();
        $action = $route['action'];

        $controller = $this->createRequestedController($route);
        if ($controller['success']) {
            $ctrl = $controller['controller'];
            $valid_action = $this->checkValidControllerAction($action, $ctrl);
            if ($valid_action['success']) {
                //Calling our actual requested controller action
                $result = $ctrl->$action($route['params']);
                return $result;
            }
        }
        $no_page = $config->Core->not_found_page;
        if (is_file($view = ROOT . "/lib/Core/View/$no_page")) {
            ob_start();
            include($view);
            $html_string = ob_get_contents();
            ob_end_clean();
            return $html_string;
        } else {
            return "No file found!";
        }
    }

    public function createRequestedController($route)
    {
        if (class_exists($controller_loc = $route['module'] . '_Controller_' . $route['controller'])) {
            try {
                $controller = new $controller_loc;
                return array(
                    "success" => true,
                    "message" => "Controller created",
                    "controller" => $controller,
                );
            } catch (Exception $ex) {
                return array(
                    "success" => false,
                    "message" => "Controller -new- creation failure"
                );
            }
        } else {
            return array(
                "success" => false,
                "message" => "Could not create requested controller"
            );
        }
    }

    public function checkValidControllerAction($action, $controller)
    {
        if (method_exists($controller, $action) && is_callable(array($controller, $action))) {
            return array(
                "success" => true,
                "message" => "Action Exists"
            );
        } else {
            return array(
                "success" => false,
                "message" => "Could not complete action"
            );
        }
    }
}