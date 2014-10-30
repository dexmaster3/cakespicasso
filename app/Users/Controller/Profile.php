<?php

class Users_Controller_Profile extends Users_Controller_BaseAuth
{
    protected function index($query = null)
    {
        $user_model = new Users_Model_User();
        $user = $user_model->findById($_SESSION['user']['id']);
        $this->data->user = $user;
        return $this->render();
    }
    protected function edit($query)
    {
        $user_model = new Users_Model_User();
        $user = $user_model->findById($_SESSION['user']['id']);
        $this->data->user = $user;
        return $this->render();
    }
    protected function save($query)
    {
        $post = Core_Request::getRequest()->post;
        $uploaddir = ROOT . "/assets/img/upload/";
        $uploadfile = time() . "_" . basename($_FILES['avatar']['name']);
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaddir . $uploadfile)) {
            $post['avatar'] = $uploadfile;
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
        $user_model->updateById($post['id'], $post);

        header("Location: /users/profile");
        return $this->renderString("Post Success");
    }
}