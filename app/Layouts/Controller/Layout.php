<?php

class Layouts_Controller_Layout extends Core_Controller_BaseController
{
    public function index()
    {
        $layouts = new Layouts_Model_Layout();
        $this->data->layouts = $layouts->getAll();
        return $this->render(__FUNCTION__);
    }

    public function post()
    {
        $post = Core_Request::getRequest()->post;
        $layouts = new Layouts_Model_Layout();
        $post['layout_content'] = htmlentities($post['layout_content']);
        $layouts->addRow($post);
        return $this->index(__FUNCTION__);
    }

    public function edit($params)
    {
        $layout = new Layouts_Model_Layout();
        $this->data->page = $layout->findById($params['id']);
        return $this->render(__FUNCTION__);
    }

    public function create()
    {
        return $this->render(__FUNCTION__);
    }

    public function blank()
    {
        return $this->render(__FUNCTION__);
    }
}