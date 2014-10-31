<?php

class Message_Controller_Message extends Users_Controller_BaseAuth
{
    protected function sendMessage($message)
    {
        $post = Core_Request::getRequest()->post;
        $post['sentfrom'] = $_SESSION['user']['id'];
        $message_model = new Message_Model_Message();
        $message_model->addRow($post);
        return $this->renderString($post);
    }
    protected function create($query)
    {
        $users_model = new Users_Model_User();
        $this->data->users = $users_model->getAll();
        $this->data->currentuser = $users_model->findById($_SESSION['user']['id']);
        return $this->render();
    }
}