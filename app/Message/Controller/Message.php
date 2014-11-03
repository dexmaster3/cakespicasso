<?php

class Message_Controller_Message extends Users_Controller_BaseAuth
{
    protected function sendMessage($message)
    {
        $post = Core_Request::getRequest()->post;
        $post['sentfrom'] = $_SESSION['user']['id'];
        $uploaddir = ROOT . "/assets/upload/";
        $uploadfile = time() . "_" . basename($_FILES['attachment']['name']);
        if(move_uploaded_file($_FILES['attachment']['tmp_name'], $uploaddir . $uploadfile)) {
            $post['attachment'] = $uploadfile;
        }
        $message_model = new Message_Model_Message();
        $message_model->addRow($post);
        return $this->all();
    }
    protected function create($query)
    {
        $users_model = new Users_Model_User();
        $this->data->users = $users_model->getAll();
        $this->data->currentuser = $users_model->findById($_SESSION['user']['id']);
        return $this->render();
    }
    protected function view($query)
    {
        $message_model = new Message_Model_Message();
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
        $message_model = new Message_Model_Message();
        $this->data->messages = $message_model->findAllMessagesForUserId($_SESSION['user']['id']);
        return $this->render();
    }
    protected function delete($query)
    {
        $message_model = new Message_Model_Message();
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