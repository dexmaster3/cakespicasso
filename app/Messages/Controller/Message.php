<?php

class Messages_Controller_Message extends Users_Controller_BaseAuth
{
    protected function sendMessage()
    {
        $post = Core_Request::getRequest()->post;
        $return_data = new stdClass();
        $post['sentfrom'] = $_SESSION['user']['id'];
        if (isset($_FILES)) {
            $uploaddir = ROOT . "/assets/upload/";
            $uploadfile = time() . "_" . basename($_FILES['attachment']['name']);
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploaddir . $uploadfile)) {
                $post['attachment'] = $uploadfile;
            }
        }
        $message_model = new Messages_Model_Message();
        $added = $message_model->addRow($post);
        if ($added) {
            $return_data->success = true;
            $return_data->type = "success";
            $return_data->message = "Message sent!";
            $return_data->redirect = "/Messages/Message";
            $activity_model = new DB_Model_ActivityLog();
            $activity = array(
                "name" => "Message Sent",
                "type" => "fa fa-fw fa-envelope",
                "description" => $_SESSION['user']['username'] . " sent a message",
                "author_id" => $_SESSION['user']['id'],
                "note" => "Message ID: ".$added
            );
            $activity_model->addRow($activity);
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
        $return_data = new stdClass();
        $messages = $message_model->findAllMessagesForUserId($_SESSION['user']['id']);
        foreach ($messages as $message) {
            if ($message['sentto'] === $_SESSION['user']['id'] && $message['message_id'] === $query['id']) {
                $message_model->deleteById($message['message_id']);
                $return_data->success = true;
                $return_data->type = "success";
                $return_data->message = "Message deleted";
                return $this->returnJson($return_data);
            }
        }
        $return_data->success = false;
        $return_data->type = "error";
        $return_data->message = "Message not found";
        return $this->returnJson($return_data);
    }
    protected function index()
    {
        return $this->all();
    }
}