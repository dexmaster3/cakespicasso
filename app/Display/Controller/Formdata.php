<?php

class Display_Controller_Formdata extends Core_Controller_BaseController
{
    public function post()
    {
        $post = Core_Request::getRequest()->post;
        $formData_model = new Display_Model_Formdata();
        $form = new stdClass();
        $form_id = $formData_model->addRow($post);
        if ($form_id) {
            $form->success = true;
            $form->message = "Row added ID: " . $form_id;
        } else {
            $form->success = false;
            $form->message = "Error adding form";
        }
        return $this->render();
    }

    public function index($query = null)
    {
        $formdata_model = new Display_Model_Formdata();
        $form_model = new Forms_Model_Form();
        $this->data->forms = $form_model->findAllByColumnValue('author_id', $_SESSION['user']['id']);
        $this->data->formdatas = $formdata_model->getAllWhereAttributeIsValue('author_id', $_SESSION['user']['id']);
        //This is for rendering as admin in non admin controller
        $body_html = $this->render();
        $admin = new Admin_Controller_Admin();
        $admin_html = $admin->index();
        $final_html = Core_View_ViewDriver::replaceShivs($admin_html, $body_html);
        return $this->renderString($final_html);

    }
}