<?php

class Users_Controller_User extends Core_Controller_BaseController
{
    public function index($query = null)
    {
        if(Users_UserHelper::checkAuth()) {
            header("Location: /admin/dashboard");
            die("You are logged in");
        } else {
            $this->data->message_type = $query[0];
            $this->data->message = $query[1];
            return $this->render(__FUNCTION__);
        }
    }

    public function register($query = null)
    {
        $users_model = new Users_Model_User();
        $post = Core_Request::getRequest()->post;
        if (empty($post['username']) || empty($post['password']) || empty($post['email'])) {
            return $this->returnJson(array(
                "success" => false,
                "message" => "Fill out the required fields"
            ));
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->returnJson(array(
                "success" => false,
                "message" => "Please enter a valid email"
            ));
        } else {
            //ToDo: change model base? cant have email duplicates not throw anything
            $found_users = $users_model->findAllByColumnValue('username', $post['username']);
            if (!empty($found_users[0])) {
                return $this->returnJson(array(
                    "success" => false,
                    "message" => "Username already in use"
                ));
            } else {
                $new_pass = Users_UserHelper::getPassword($post['password']);
                $post['password'] = $new_pass['password'];
                $post['salt'] = $new_pass['salt'];
                $user_id = $users_model->addRow($post);
                if ($user_id > 0) {
                    return $this->returnJson(array(
                        "success" => true,
                        "message" => "User created! Please log in"
                    ));
                } else {
                    return $this->returnJson(array(
                        "success" => false,
                        "message" => "Error creating user"
                    ));
                }
            }
        }
    }

    public function login($query = null)
    {
        $logged_in = false;
        $users_model = new Users_Model_User();
        $post = Core_Request::getRequest()->post;
        if (!empty($post['username']) && !empty($post['password'])) {
            $found_users = $users_model->findAllByColumnValue('username', $post['username']);
            if (isset($found_users[0])) {
                $logged_in = Users_UserHelper::checkPassword($found_users[0], $post['password']);
            }
            if ($logged_in) {
                session_start();
                $_SESSION['user'] = $found_users[0];
                $usersname = $found_users[0]['username'];
                return $this->returnJson(array(
                    "success" => true,
                    "message" => "Welcome back $usersname"
                ));
            }
            return $this->returnJson(array(
                "success" => false,
                "message" => "Wrong Username or Password"
            ));
        } else {
            return $this->returnJson(array(
                "success" => false,
                "message" => "Enter both Username and Password"
            ));
        }
    }

    public function logout($query = null)
    {
        session_start();
        unset($_SESSION['user']);
        return $this->returnJson(array(
            "message" => "Goodbye",
            "success" => true
        ));
    }
}