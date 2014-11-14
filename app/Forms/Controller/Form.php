<?php

class Forms_Controller_Form extends Users_Controller_BaseAuth
{
    protected function index()
    {
        $form_model = new Forms_Model_Form();
        $this->data->forms = $form_model->findAllByColumnValue('author_id', $_SESSION['user']['id']);
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
            $delete_data->type = "success";
        } else {
            $delete_data->message = "Row ID not set";
            $delete_data->success = false;
            $delete_data->type = "error";
        }
        return $this->returnJson($delete_data);
    }
    protected function save()
    {
        $post = Core_Request::getRequest()->post;
        $form_model = new Forms_Model_Form();
        $form = new stdClass();
        $post['author_id'] = $_SESSION['user']['id'];
        $post['form_html'] = Forms_FormHelper::preprocessHtml($post['form_html'], $_SESSION['user']['id']);
        $form_id = $form_model->addRow($post);
        if ($form_id) {
            $form->success = true;
            $form->message = "Row added ID: " . $form_id;
            $form->redirect = "/Forms/Form";
            $form->type = "success";
        } else {
            $form->success = false;
            $form->message = "Error adding form";
            $form->type = "error";
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