<?php

class Messages_Controller_Message extends Users_Controller_BaseAuth
{
    protected function sendMessage()
    {
        $post = Core_Request::getRequest()->post;
        $return_data = new stdClass();
        $post['sentfrom'] = $_SESSION['user']['id'];
        $uploaddir = ROOT . "/assets/upload/";
        $uploadfile = time() . "_" . basename($_FILES['attachment']['name']);
        if(move_uploaded_file($_FILES['attachment']['tmp_name'], $uploaddir . $uploadfile)) {
            $post['attachment'] = $uploadfile;
        }
        $message_model = new Messages_Model_Message();
        $added = $message_model->addRow($post);
        if ($added) {
            $return_data->success = true;
            $return_data->type = "success";
            $return_data->message = "Message sent!";
            $return_data->redirect = "/Messages/Message";
        } else {
            $return_data->success = false;
            $return_data->type = "error";
            $return_data->message = "Error sending message";
        }
        return $this->returnJson($return_data);
    }
    protected function create()
    {
        $users_model = new Users_Model_User();
        $this->data->users = $users_model->getAll();
        $this->data->currentuser = $users_model->findById($_SESSION['user']['id']);
        return $this->render();
    }
    protected function view($query = null)
    {
        $message_model = new Messages_Model_Message();
        $messages = $message_model->findAllMessagesForUserId($_SESSION['user']['id']);
        foreach ($messages as $message) {
            if ($message['sentto'] === $_SESSION['user']['id'] && $message['message_id'] === $query['id']) {
                $this->data->message = $message;
                return $this->render();
            }
        }
        return $this->renderString("This isn't your message");
    }
    protected function all()
    {
        $message_model = new Messages_Model_Message();
        $this->data->messages = $message_model->findAllMessagesForUserId($_SESSION['user']['id']);
        return $this->render();
    }
    protected function delete($query = null)
    {
        $message_model = new Messages_Model_Message();
        $messages = $message_model->findAllMessagesForUserId($_SESSION['user']['id']);
        foreach ($messages as $message) {
            if ($message['sentto'] === $_SESSION['user']['id'] && $message['message_id'] === $query['id']) {
                $message_model->deleteById($message['message_id']);
                return $this->all();
            }
        }
        return $this->renderString("This isn't your message");
    }
    protected function index()
    {
        return $this->all();
    }
}