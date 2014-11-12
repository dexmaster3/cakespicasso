<?php

class Forms_Controller_Form extends Users_Controller_BaseAuth
{
    protected function index()
    {
        $form_model = new Forms_Model_Form();
        $this->data->forms = $form_model->getAll();
        return $this->render(__FUNCTION__);
    }

    protected function create()
    {
        $this->data->page = null;
        return $this->render();
    }

    protected function delete($query = null)
    {
        $delete_data = new stdClass();
        if($query['id'] > 0) {
            $form_model = new Forms_Model_Form();
            $delete_data->message = "Rows deleted: " . $form_model->deleteById($query['id']);
            $delete_data->success = true;
        } else {
            $delete_data->message = "Row ID not set";
            $delete_data->success = false;
        }
        return $this->returnJson($delete_data);
    }
    protected function save()
    {
        $post = Core_Request::getRequest()->post;
        $form_model = new Forms_Model_Form();
        $form = new stdClass();
        $form_id = $form_model->addRow($post);
        if ($form_id) {
            $form->success = true;
            $form->message = "Row added ID: " . $form_id;
        } else {
            $form->success = false;
            $form->message = "Error adding form";
        }
        return $this->returnJson($form);
    }
    protected function ajaxshow($query = null)
    {
        $form_model = new Forms_Model_Form();
        $forms = $form_model->getAll();
        return $this->returnJson($forms);
    }
}