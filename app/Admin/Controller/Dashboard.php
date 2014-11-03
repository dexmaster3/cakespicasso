<?php

class Admin_Controller_Dashboard extends Users_Controller_BaseAuth
{
    protected function index($query = null)
    {
        $messages_model = new Message_Model_Message();
        $this->data->messages = $messages_model->findAllMessagesForUserId($_SESSION['user']['id']);
        return $this->render();
    }
}