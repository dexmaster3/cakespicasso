<?php

class Users_Controller_Profile extends Users_Controller_BaseAuth
{
    protected function index($query = null)
    {
        $query = array(
            "id" => $_SESSION['user']['id']
        );
        return $this->show($query);
    }
    protected function edit($query)
    {
        $user_model = new Users_Model_User();
        $user = $user_model->getUser($_SESSION['user']['id']);
        $this->data->user = $user;
        return $this->render();
    }
    protected function avatar($query = null)
    {
        $user_model = new Users_Model_User();
        $this->data->user = $user_model->findById($_SESSION['user']['id']);
        return $this->render();
    }
    protected function deleteavatar($query = null)
    {
        $user_model = new Users_Model_User();
        $user = $user_model->findById($_SESSION['user']['id']);
        $user['avatar'] = null;
        $user['avatar_crop'] = null;
        $sql_run = $user_model->updateById($_SESSION['user']['id'], $user);
        if ($sql_run) {
            return $this->returnJson(array(
                "message" => "Avatar Deleted",
                "type" => "success",
                "success" => true
            ));
        } else {
            return $this->returnJson(array(
                "message" => "Avatar could not be deleted",
                "type" => "error",
                "success" => false
            ));
        }
    }
    protected function postavatar($query = null)
    {
        $post = Core_Request::getRequest()->post;
        $user_model = new Users_Model_User();
        $user = $user_model->findById($_SESSION['user']['id']);
        $avatar_name = time() . "_avatar_" . $user['username'] . ".jpg";
        $file_name = ROOT . "/assets/upload/$avatar_name";
        $filestream = fopen($file_name, "wb");
        $data = explode("base64,", $post['image']);
        fwrite($filestream, base64_decode($data[1]));
        fclose($filestream);
        if (is_file($file_name)) {
            $sql_run = $user_model->updateById($_SESSION['user']['id'], array("avatar_crop" => $avatar_name));
            if ($sql_run) {
                $_SESSION['user']['avatar_crop'] = $avatar_name;
                return $this->returnJson(array(
                    "message" => "Avatar Saved",
                    "type" => "success",
                    "success" => true,
                    "redirect" => "/users/profile"
                ));
            } else {
                return $this->returnJson(array(
                    "message" => "Error sql couldn't save",
                    "type" => "error",
                    "success" => false
                ));
            }
        } else {
            return $this->returnJson(array(
                "message" => "Error saving Avatar",
                "type" => "error",
                "success" => false
            ));
        }
    }
    protected function save($query)
    {
        $avatar_change = false;
        $post = Core_Request::getRequest()->post;
        $uploaddir = ROOT . "/assets/upload/";
        $uploadfile = time() . "_" . basename($_FILES['avatar']['name']);
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaddir . $uploadfile)) {
            $post['avatar'] = $uploadfile;
            $avatar_change = true;
        }
        if (!empty($post['old_password']) && !empty($post['new_password']) && !empty($post['new_password_confirm'])
        && ($post['new_password'] === $post['new_password_confirm'])) {
            $correct_pw = Users_UserHelper::checkPassword($_SESSION['user'], $post['old_password']);
            if ($correct_pw) {
                $new_pw = Users_UserHelper::getPassword($post['new_password']);
                $post['salt'] = $new_pw['salt'];
                $post['password'] = $new_pw['password'];
            }
        }
        $post['birthday'] = date("Y-m-d", strtotime($post['birthday']));
        $user_model = new Users_Model_User();
        $sql_run = $user_model->updateById($post['id'], $post);
        if ($sql_run) {
            if ($avatar_change) {
                //Change so we dont have to log them out to refresh session
                $_SESSION['user']['avatar'] = $uploadfile;
                return $this->returnJson(array(
                    "message" => "Profile Updated",
                    "type" => "success",
                    "success" => true,
                    "redirect" => "/users/profile/avatar"
                ));
            } else {
                return $this->returnJson(array(
                    "message" => "Profile Updated",
                    "type" => "success",
                    "success" => true,
                    "redirect" => "/users/profile"
                ));
            }
        } else {
            return $this->returnJson(array(
                "message" => "Error saving profile",
                "type" => "error",
                "success" => false
            ));
        }
    }
    protected function showAll($query)
    {
        $users_model = new Users_Model_User();
        $this->data->users = $users_model->getAllUsers();
        return $this->render();
    }
    protected function show($query = null)
    {
        $user_model = new Users_Model_User();
        $note_model = new Users_Model_Note();
        $this->data->user_notes = $note_model->findAllByColumnValueWhereNoParent("profile_id", $query['id']);
        foreach ($this->data->user_notes as $key => $val) {
            $this->data->user_notes[$key]['sub_notes'] = $note_model->findAllByColumnValue('parent_note', $val['id']);
        }
        $this->data->user = $user_model->getUser($query['id']);
        $this->data->all_users = $user_model->getAllUsers();
        return $this->render(__FUNCTION__);
    }
    protected function postnote($query = null)
    {
        $post = Core_Request::getRequest()->post;
        $note_model = new Users_Model_Note();
        $post['author_id'] = $_SESSION['user']['id'];
        if(!isset($post['parent_note']) && !$post['parent_note'] > 0) {
            $post['parent_note'] = 0;
        }
        $sql_run = $note_model->addRow($post);
        if ($sql_run) {
            return $this->returnJson(array(
                "success" => true,
                "type" => "success",
                "message" => "Comment posted"
            ));
        } else {
            return $this->returnJson(array(
                "success" => false,
                "type" => "error",
                "message" => "Comment save error"
            ));
        }
    }
}