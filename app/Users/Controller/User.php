<?php

class Users_Controller_User extends Core_Controller_BaseController
{
    public function index($query = null)
    {
        return $this->render();
    }

    public function register($query = null)
    {
        $users_model = new Users_Model_User();
        $post = Core_Request::getRequest()->post;
        if (empty($post['username']) || empty($post['password']) || empty($post['email'])) {
            return $this->renderString("Please fill out all required fields");
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->renderString("Please enter a valid email");
        } else {
            $found_users = $users_model->findAllByColumnValue('username', $post['username']);
            if (!empty($found_users[0])) {
                return $this->renderString("Username already in use");
            } else {
                $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
                $password = hash('sha256', $post['password'] . $salt);
                $post['password'] = $password;
                $post['salt'] = $salt;
                $user_id = $users_model->addRow($post);
                if ($user_id > 0) {
                    return $this->render();
                } else {
                    return $this->renderString("Error creating user");
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
                $pw_check = hash('sha256', $post['password'] . $found_users[0]['salt']);
                if ($pw_check === $found_users[0]['password']) {
                    $logged_in = true;
                }
            }
            if ($logged_in) {
                session_start();
                unset($found_users[0]['salt']);
                unset($found_users[0]['password']);
                $_SESSION['user'] = $found_users[0];
                $layouts = new Layouts_Controller_Layout();
                return $layouts->index();
            }
        }
    }

    public function logout($query = null)
    {
        session_start();
        unset($_SESSION['user']);
        return $this->index();
    }
}