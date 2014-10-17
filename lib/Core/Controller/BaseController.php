<?php

abstract class Core_Controller_BaseController
{
    protected $view_file;
    protected $data = null;

    public function setView($action)
    {
        $config = Core_Config::getConfig();
        $route = Core_Router::getRoute();

        $module = $route['module'];
        $controller = $route['controller'];

        $current_config = $config->$module;
        $lower_action = strtolower($action);
        $view_for_action = $current_config->views->$controller->$lower_action;

        //ToDo: Abstractify this 4 fun
        if (is_file($view = ROOT . "/app/$module/View/$view_for_action")) {
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

    protected function render($html = null)
    {
        if (!empty($html)) {
            return $html;
        } else {
            include $this->view_file;
            return $this->view_file;
        }
    }
}