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
        //ToDo: Find out how to relate and get senders name rather than just ID
        $message_model = new Message_Model_Message();
        $user_model = new Users_Model_User();
        $this->data->messages = $message_model->findAllByColumnValue('sentto', $_SESSION['user']['id']);
        foreach($this->data->messages as $message) {
            $this->data->users = $user_model->findById($message['sentfrom']);
        }
        return $this->render(__FUNCTION__);
    }
}