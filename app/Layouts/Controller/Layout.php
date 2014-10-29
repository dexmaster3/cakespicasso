<?php

class Layouts_Controller_Layout extends Users_Controller_BaseAuth
{
    protected function index()
    {
        $layouts = new Layouts_Model_Layout();
        $this->data->layouts = $layouts->getAll();

        $layout_html = $this->render(__FUNCTION__);
        return $layout_html;
    }

    protected function post()
    {
        $post = Core_Request::getRequest()->post;
        $layouts = new Layouts_Model_Layout();
        $post['layout_content'] = htmlentities($post['layout_content']);
        $post['layout_author'] = $_SESSION['user']['id'];
        $layouts->addRow($post);
        return $this->index(__FUNCTION__);
    }

    protected function edit($params)
    {
        $layout = new Layouts_Model_Layout();
        $this->data->page = $layout->findById($params['id']);
        return $this->render(__FUNCTION__);
    }

    protected function delete($params)
    {
        $layout_model = new Layouts_Model_Layout();
        $rows_deleted = $layout_model->deleteById($params['id']);
        return $this->index();
    }

    protected function create()
    {
        return $this->render(__FUNCTION__);
    }
}