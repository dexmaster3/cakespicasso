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

/*        if (class_exists($current_module . '_View_' . $view_for_action)) {
            $view = new $current_module . '_View_' . $view_for_action;
        }*/
        //ToDo: Proper no view file found handling
        else {
            throw new Exception("View Not Found");
        }
    }

    protected function render($data)
    {
        //$view_string = file_get_contents($this->view_file);
/*        foreach ($data as $datak => $datav) {
            $view_string = str_replace($datak, $datav, $view_string);
        }*/
        //$final_view = str_replace(array_keys($data), array_values($data), $view_string);
        require_once $this->view_file;
        return $this->view_file;
    }
}