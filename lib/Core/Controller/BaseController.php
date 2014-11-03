<?php

abstract class Core_Controller_BaseController
{
    protected $view_file;
    protected $data;

    public function __construct()
    {
        $this->data = new stdClass();
    }

    public function setView($action)
    {
        $config = Core_Config::getConfig();

        $class_name = get_class($this);
        $class_parts = explode('_', $class_name);

        $current_config = $config->$class_parts[0];
        $controller = $class_parts[2];

        $laction = strtolower($action);
        $view_for_action = $current_config->views->$controller->$laction;

        if (is_file($view = ROOT . "/app/$class_parts[0]/View/$view_for_action")) {
            $this->view_file = $view;
        } else {
            $no_page = $config->Core->not_found_page;
            if (is_file($view = ROOT . "/lib/Core/View/$no_page")) {
                $this->view_file = $view;
            } else {
                throw new Exception("Page not found!");
            }
        }
    }

    protected function returnJson($data)
    {
        header("Content-type: application/json");
        $json_encoded = json_encode($data);
        return $json_encoded;
    }

    protected function renderString($html)
    {
        return $html;
    }

    protected function render($calling_function = null)
    {
        $route = Core_Router::getRoute();
        if (is_null($calling_function)) {
            $calling_function = $route['action'];
        }
        $this->setView($calling_function);
        if (is_file($this->view_file)) {
            ob_start();
            include($this->view_file);
            $html_string = ob_get_contents();
            ob_end_clean();
            return $html_string;
        } else {
            return "No view found for that action, check module config";
        }
    }
}