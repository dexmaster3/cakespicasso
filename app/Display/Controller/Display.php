<?php

class Display_Controller_Display extends Core_Controller_BaseController
{
    public function index($query)
    {
        //ToDo: Matching pattern and getting layout to replace
        $page = new Layouts_Model_Layout();
        $layout = $page->findAllByColumnValue('layout_name', $query['layout']);
        if (!is_null($layout[0])) {
            $layout_string = html_entity_decode($layout[0]['layout_content']);
            $layout_matches = array();
            $working = preg_match('/(?:{{layout_id=([\d]{1,})}})/ig', $layout_string, $layout_matches);
            foreach ($layout_matches as $match) {
                $test = $match;
                $rag = 1;
            }
            return $this->render($layout[0]['layout_content']);
        }
        echo "Invalid display layout";
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