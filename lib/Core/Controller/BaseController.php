<?php

abstract class Core_Controller_BaseController
{
    protected $view_file;
    protected $data = null;

    public function setView($action)
    {
        $config = Core_Config::getConfig();

        $class_name = get_class($this);
        $parts = explode('_', $class_name);

        $current_config = $config->$parts[0];
        $controller = $parts[2];

        $view_for_action = $current_config->views->$controller->$action;

        if (is_file($view = ROOT . "/app/$parts[0]/View/$view_for_action")) {
            $this->view_file = $view;
        }
        else {
            $no_page = $config->Core->not_found_page;
            if (is_file($view = ROOT . "/lib/Core/View/$no_page")) {
                $this->view_file = $view;
            } else {
                throw new Exception("Page not found!");
            }
        }
    }

    public function setViewForCaller($action)
    {
        $config = Core_Config::getConfig();

        $class_name = get_class($this);
        $parts = explode('_', $class_name);

        $current_config = $config->$parts[0];
        $controller = $parts[2];

        $view_for_action = $current_config->views->$controller->$action;

        if (is_file($view = ROOT . "/app/$parts[0]/View/$view_for_action")) {
            $this->view_file = $view;
        }
    }

    /**
     * This should return standardized data for the calling controller so it can be passed around
     * @param null $html
     * @param null $calling_function
     * @return array (string html, object data)
     * @throws Exception
     */
    protected function render($html = null, $calling_function = null)
    {
        $route = Core_Router::getRoute();
        if (is_null($calling_function)) {
            $calling_function = $route->action;
        }
        $this->setView($calling_function);
        if (!empty($html)) {
            return array($template = false, $html);
        } else {
            return array($template = true, $this->view_file, $this->data);
        }
    }
}