<?php

class Display_Controller_Display extends Core_Controller_BaseController
{
    public function index($query)
    {
        $page = new Layouts_Model_Layout();
        $layout = $page->findAllByColumnValue('layout_name', $query['layout']);
        if (!is_null($layout[0])) {
            $layouts = array();
            while (($position = stripos($layout[0]['layout_content'], "{{layout_id=")) !== false) {
                array_push($layouts, $position);
            }
        }
        return $this->render($layout[0]['layout_content']);
    }

    public function create($query)
    {
        return $this->render();
    }

    public function blank($query)
    {
        return $this->render();
    }
}