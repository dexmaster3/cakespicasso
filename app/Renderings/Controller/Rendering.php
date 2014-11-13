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
    protected function delete($query = null)
    {
        $rendering_model = new Renderings_Model_Rendering();
        $return_data = new stdClass();
        $deleted = $rendering_model->deleteById($query['id']);
        if($deleted > 0) {
            $return_data->success = true;
            $return_data->type = "success";
            $return_data->message = "Rendering ".$query['id']." deleted";
        } else {
            $return_data->success = false;
            $return_data->type = "error";
            $return_data->message = "Error deleting rendering";
        }
        return $this->returnJson($return_data);
    }
    protected function save()
    {
        //ToDo: The ordering of the content/forms was sometimes off because of how it is posted/parsed
        $post = Core_Request::getRequest()->post;
        $return_data = new stdClass();
        $rendering_model = new Renderings_Model_Rendering();
        $full_html = "";

        //Array value flattener
        $output = array();
        array_walk_recursive($post, function ($current) use (&$output) {
            $output[] = $current;
        });
        foreach ($output as $val){
            $full_html .= $val;
        }
        $rendering = array(
            'author_id' => $_SESSION['user']['id'],
            'html_string' => $full_html
        );
        $added = $rendering_model->addRow($rendering);

        if ($added > 0) {
            $return_data->success = true;
            $return_data->type = "success";
            $return_data->message = "Rendering added";
            $return_data->redirect = "/Renderings/Rendering";
        } else {
            $return_data->success = false;
            $return_data->type = "error";
            $return_data->message = "Error saving rendering";
        }
        return $this->returnJson($return_data);
    }
    protected function ajaxshow()
    {
        $rendering_model = new Renderings_Model_Rendering();
        $renderings = $rendering_model->getAll();
        return $this->returnJson($renderings);
    }
}