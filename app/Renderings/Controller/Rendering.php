<?php

class Renderings_Controller_Rendering extends Users_Controller_BaseAuth
{
    protected function index()
    {
        $rendering_model = new Renderings_Model_Rendering();
        $renderings = $rendering_model->getAll();
        $this->data->renderings = array_reverse($renderings);
        return $this->render();
    }
    protected function create()
    {
        $layout_model = new Layouts_Model_Layout();
        $layout = $layout_model->getAll();
        $this->data->layouts = $layout;
        return $this->render();
    }
    protected function save()
    {
        $post = Core_Request::getRequest()->post;
        $rendering_model = new Renderings_Model_Rendering();
        $full_html = "";
        foreach ($post as $key => $val){
            $full_html .= $val;
        }
        $rendering = array(
            'author_id' => $_SESSION['user']['id'],
            'html_string' => $full_html
        );
        $rendering_model->addRow($rendering);
        return $this->index();
    }
    protected function ajaxshow()
    {
        $rendering_model = new Renderings_Model_Rendering();
        $renderings = $rendering_model->getAll();
        return $this->returnJson($renderings);
    }
}