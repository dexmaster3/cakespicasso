<?php

class Admin_Controller_Admin extends Core_Controller_BaseController
{
    /**
     * This is the main admin layout that gets rendered over any admin content
     * @param null $query
     * @return string the Admin html frame
     */
    public function index($query = null)
    {
        $message_model = new Message_Model_Message();
        $this->data->messages = $message_model->findAllMessagesForUserId($_SESSION['user']['id']);
        return $this->render(__FUNCTION__);
    }

    public function noadmin($query = null)
    {
        return $this->render(__FUNCTION__);
    }
}