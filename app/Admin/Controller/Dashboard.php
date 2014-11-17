<?php

class Admin_Controller_Dashboard extends Users_Controller_BaseAuth
{
    protected function index($query = null)
    {
        $messages_model = new Messages_Model_Message();
        $pages_model = new Pages_Model_Page();
        $forms_model = new Forms_Model_Form();
        $formdata_model = new Display_Model_Formdata();
        $layouts_model = new Layouts_Model_Layout();
        $renderings_model = new Renderings_Model_Rendering();
        $activity_model = new DB_Model_ActivityLog();

        $user_id = $_SESSION['user']['id'];
        $this->data->messages = $messages_model->findAllMessagesForUserId($user_id);
        $pages = $pages_model->findAllByColumnValue('author_id', $user_id);
        $forms = $forms_model->findAllByColumnValue('author_id', $user_id);
        $formdata = $formdata_model->getAllWhereAttributeIsValue('author_id', $user_id);
        $layouts = $layouts_model->findAllByColumnValue('author_id', $user_id);
        $renderings = $renderings_model->findAllByColumnValue('author_id', $user_id);
        $this->data->activities = $activity_model->getAll();

        $this->data->donut = new stdClass();
        $this->data->donut->pages = count($pages);
        $this->data->donut->forms = count($forms);
        $this->data->donut->formdata = count($formdata);
        $this->data->donut->layouts = count($layouts);
        $this->data->donut->renderings = count($renderings);
        return $this->render();
    }
    protected function activity($query = null)
    {
        $activity_model = new DB_Model_ActivityLog();
        $users_model = new Users_Model_User();
        $this->data->users = $users_model->getAll();
        if(isset($query['user']) && $query['user'] > 0) {
            $this->data->activities = $activity_model->findAllByColumnValue('author_id', $query['user']);
        } else {
            $this->data->activities = $activity_model->getAll();
        }
        return $this->render();
    }
}