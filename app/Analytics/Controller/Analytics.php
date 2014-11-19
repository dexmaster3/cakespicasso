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
        //TODO SAVE USER IF LOGGED< OTHERWISE PUBLIC
        //$_POST ONLY contains form-encoded data, not stuff sent as a JSON string
        $post = Core_Request::getRequest()->post;
        $click_model = new Analytics_Model_Click();
        $max_row = $click_model->addMultiRow($post['data']);
        return $this->returnJson($max_row);
    }
}