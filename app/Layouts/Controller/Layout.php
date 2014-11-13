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
        $data_return = new stdClass();
        $layouts = new Layouts_Model_Layout();
        $post['layout_content'] = htmlentities($post['layout_content']);
        $post['layout_author'] = $_SESSION['user']['id'];
        $added = $layouts->addRow($post);
        if ($added > 0) {
            $data_return->success = true;
            $data_return->type = "success";
            $data_return->message = "Layout :".$added." successfully added";
            $data_return->redirect = "/Layouts/Layout";
        } else {
            $data_return->success = false;
            $data_return->type = "error";
            $data_return->message = "Error adding layout";
        }
        return $this->returnJson($data_return);
    }

    protected function edit($params)
    {
        $layout = new Layouts_Model_Layout();
        $this->data->page = $layout->findById($params['id']);
        return $this->render(__FUNCTION__);
    }

    protected function delete($params = null)
    {
        $return_data = new stdClass();
        if ($params['id'] > 0) {
            $layout_model = new Layouts_Model_Layout();
            $return_data->success = true;
            $return_data->type = "success";
            $return_data->message = "Layouts deleted: ".$layout_model->deleteById($params['id']);
        } else {
            $return_data->success = false;
            $return_data->message = "Layout ID not set";
            $return_data->type = "error";
        }
        return $this->returnJson($return_data);
    }

    protected function create()
    {
        $this->data->page = null;
        return $this->render(__FUNCTION__);
    }
}