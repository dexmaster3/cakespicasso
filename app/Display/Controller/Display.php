<?php

class Display_Controller_Display extends Core_Controller_BaseController
{
    public function index($query)
    {
        $layout_model = new Layouts_Model_Layout();
        $layout = $layout_model->findAllByColumnValue('layout_name', $query['layout']);
        $layout_renderer = new Display_DisplayHelper();
        $layout_string = html_entity_decode($layout[0]['layout_content']);
        $return_layout = $layout_renderer->renderLayoutContent($layout_string);
        return $this->render($return_layout);
    }

    public function layout($query)
    {
        $layout_model = new Layouts_Model_Layout();
        $layout = $layout_model->findById($query['id']);
        $layout_renderer = new Display_DisplayHelper();
        $layout_string = html_entity_decode($layout['layout_content']);
        $return_layout = $layout_renderer->renderLayoutContent($layout_string);
        return $this->renderString($return_layout);
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