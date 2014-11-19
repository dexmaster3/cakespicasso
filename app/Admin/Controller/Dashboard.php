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
        $activity_model = new Analytics_Model_ActivityLog();
        $tracker_model = new Analytics_Model_Tracker();
        $click_model = new Analytics_Model_Click();

        $user_id = $_SESSION['user']['id'];
        $this->data->messages = $messages_model->findAllMessagesForUserId($user_id);
        $pages = $pages_model->findAllByColumnValue('author_id', $user_id);
        $forms = $forms_model->findAllByColumnValue('author_id', $user_id);
        $formdata = $formdata_model->getAllWhereAttributeIsValue('author_id', $user_id);
        $layouts = $layouts_model->findAllByColumnValue('author_id', $user_id);
        $renderings = $renderings_model->findAllByColumnValue('author_id', $user_id);
        $this->data->activities = $activity_model->getAll();
        $this->data->trackings = $tracker_model->getAll();
        $this->data->clicks = $click_model->totalCount();

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
        $activity_model = new Analytics_Model_ActivityLog();
        $users_model = new Users_Model_User();
        $this->data->users = $users_model->getAll();
        if(isset($query['user']) && $query['user'] > 0) {
            $this->data->activities = $activity_model->findAllByColumnValue('author_id', $query['user']);
        } else {
            $this->data->activities = $activity_model->getAll();
        }
        return $this->render();
    }

    protected function visitors($query = null)
    {
        $tracker_model = new Analytics_Model_Tracker();
        $this->data->trackings = $tracker_model->getAll();
        return $this->render();
    }

    protected function clicks($query = null)
    {
        $clicks_model = new Analytics_Model_Click();
        $this->data->clicks = $clicks_model->getAll();
        return $this->render();
    }
    protected function getNextClicks($query = null)
    {
        //TODO Do search boxes by column?
        $post = Core_Request::getRequest()->post;
        $clicks_model = new Analytics_Model_Click();
        $clicks_count = $clicks_model->totalCount();

        if (!empty($post['search']['value'])) {
            $clicks = $clicks_model->findAllByAnyValueLimit($post['search']['value'], $post['start'], $post['length']);
            $records_filtered = $clicks_model->findAllByAnyValueLimitCount($post['search']['value']);
        } elseif (!empty($post['order'][0]['column'])) {
            $column_id = $post['order'][0]['column'];
            $order_column = $post['columns'][$column_id]['data'];
            $clicks = $clicks_model->getNumStartingOnOrderBy($post['start'], $post['length'], $order_column);
            $records_filtered = $clicks_model->getNumStartingOnOrderByCount($order_column);
        } else {
            $clicks = $clicks_model->getNumStartingOn($post['start'], $post['length']);
            $records_filtered = $clicks_count;
        }

        $dt_return = new stdClass();
        $dt_return->draw = $post['draw'];
        $dt_return->recordsFiltered = $records_filtered[0];
        $dt_return->recordsTotal = $clicks_count[0];
        $dt_return->data = $clicks;
        return $this->returnJson($dt_return);
    }
}