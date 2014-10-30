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
            return $this->render();
        }
    }

    public function register($query = null)
    {
        $users_model = new Users_Model_User();
        $post = Core_Request::getRequest()->post;
        if (empty($post['username']) || empty($post['password']) || empty($post['email'])) {
            return $this->index(array("alert-warning", "Fill out the required fields"));
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->index("Please enter a valid email");
        } else {
            //ToDo: change model base? cant have email duplicates not throw anything
            $found_users = $users_model->findAllByColumnValue('username', $post['username']);
            if (!empty($found_users[0])) {
                return $this->index(array("alert-danger", "Username already in use"));
            } else {
                $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
                $password = hash('sha256', $post['password'] . $salt);
                for ($test = 0; $test < 999; $test++) {
                    $password = hash('sha256', $password . $salt);
                }
                $post['password'] = $password;
                $post['salt'] = $salt;
                $user_id = $users_model->addRow($post);
                if ($user_id > 0) {
                    return $this->index(array("alert-success", "User Succesfully Created!"));
                } else {
                    return $this->index(array("alert-danger", "Error creating user"));
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
                //$logged_in = Users_UserHelper::checkPassword($found_users[0], $post['password']);
                $pw_check = hash('sha256', $post['password'] . $found_users[0]['salt']);
                for ($test = 0; $test < 999; $test++) {
                    $pw_check = hash('sha256', $pw_check . $found_users[0]['salt']);
                }
                $logged_in = $pw_check === $found_users[0]['password'];
            }
            if ($logged_in) {
                session_start();
                $_SESSION['user'] = $found_users[0];
                header("Location: /admin/dashboard");
                die("Login Successful");
            }
            return $this->index(array("alert-danger", "Wrong user/password"));
        } else {
            return "Enter both Username and Password";
        }
    }

    public function logout($query = null)
    {
        session_start();
        unset($_SESSION['user']);
        return $this->index(array("alert-success", "You have logged out"));
    }
}