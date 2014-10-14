<?php

abstract class Core_Controller_BaseController
{
    protected $view_file;
    protected $data = null;

    public function setView($action)
    {
        $current_module = Core_Router::getRoute()['module'];
        $current_config = Core_Config::getConfig()->$current_module;
        $view_for_action = $current_config->views->$action;

        if (is_file($view = ROOT . "/app/$current_module/View/$view_for_action.php")) {
            $this->view_file = $view;
        }
        //ToDo: Proper no view file found handling
        else {
            throw new Exception("View Not Found");
        }
    }

    protected function render()
    {
        require_once $this->view_file;
        return $this->view_file;
    }
}