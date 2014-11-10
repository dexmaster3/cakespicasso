<?php

class Forms_Controller_Formdata extends Core_Controller_BaseController
{
    public function post()
    {
        $post = Core_Request::getRequest()->post;
        $formData_model = new Forms_Model_Formdata();
        $form = new stdClass();
        $form_id = $formData_model->addRow($post);
        if ($form_id) {
            $form->success = true;
            $form->message = "Row added ID: " . $form_id;
        } else {
            $form->success = false;
            $form->message = "Error adding form";
        }
        return $this->returnJson($form);
    }
}