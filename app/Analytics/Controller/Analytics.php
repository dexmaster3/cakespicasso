<?php

class Analytics_Controller_Analytics extends Core_Controller_BaseController
{
    public function index($query = null)
    {
        $message_model = new Messages_Model_Message();
        $this->data->messages = $message_model->findAllMessagesForUserId($_SESSION['user']['id']);
        return $this->render(__FUNCTION__);
    }

    public function postclicks($query = null)
    {
        //$_POST ONLY contains form-encoded data, not stuff sent as a JSON string
        $post = Core_Request::getRequest()->post;
        $click_model = new Analytics_Model_Click();
        $max_row = $click_model->addMultiRow($post['data']);
        return $this->returnJson($max_row);
    }
    public function getNextClicks($query = null)
    {
        if (Users_UserHelper::checkAuth()) {
            $post = Core_Request::getRequest()->post;
            $clicks_model = new Analytics_Model_Click();
            $clicks_count = $clicks_model->totalCount();

            if ($post['specificpage']) {
                //To truly prevent non-owner click views, need to grab page model here and check it
                $clicks = $clicks_model->findAllByAnyValue($post['pageurl']);
                $records_filtered = $clicks_model->findAllByAnyValueLimitCount($post['pageurl']);
            } elseif (!empty($post['search']['value'])) {
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
        } else {
            return $this->returnJson(array(
                "message" => "Not logged in -> cannot access data"
            ));
        }
    }
}