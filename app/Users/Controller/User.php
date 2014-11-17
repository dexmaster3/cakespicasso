<?php

class Users_Controller_User extends Core_Controller_BaseController
{
    public function index($query = null)
    {
        if(Users_UserHelper::checkAuth()) {
            header("Location: /admin/dashboard");
            die("You are logged in");
        } else {
            return $this->render(__FUNCTION__);
        }
    }
    public function showregister($query = null)
    {
        return $this->render();
    }

    public function register($query = null)
    {
        $users_model = new Users_Model_User();
        $post = Core_Request::getRequest()->post;
        if (empty($post['username']) || empty($post['password']) || empty($post['email'])) {
            $this->data->message = array(
                "success" => false,
                "message" => "Fill out the required fields",
                "type" => "warn"
            );
            if ($post['ajax']) {
                return $this->returnJson($this->data->message);
            } else {
                return $this->render();
            }
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->data->message = array(
                "success" => false,
                "message" => "Please enter a valid email",
                "type" => "warn"
            );
            if ($post['ajax']) {
                return $this->returnJson($this->data->message);
            } else {
                return $this->render();
            }
        } else {
            //ToDo: change model base? cant have email duplicates not throw anything
            $found_users = $users_model->findAllByColumnValue('username', $post['username']);
            if (!empty($found_users[0])) {
                $this->data->message = array(
                    "success" => false,
                    "message" => "Username already in use",
                    "type" => "error"
                );
                if ($post['ajax']) {
                    return $this->returnJson($this->data->message);
                } else {
                    return $this->render();
                }
            } else {
                $new_pass = Users_UserHelper::getPassword($post['password']);
                $post['password'] = $new_pass['password'];
                $post['salt'] = $new_pass['salt'];
                $user_id = $users_model->addRow($post);
                if ($user_id > 0) {
                    $this->data->message = array(
                        "success" => true,
                        "message" => "User created! Please log in",
                        "type" => "success",
                        "redirect" => "/"
                    );
                    $activity_model = new DB_Model_ActivityLog();
                    $activity = array(
                        "name" => "New User Registered",
                        "type" => "fa fa-fw fa-user",
                        "description" => "A new user has registered",
                        "author_id" => $user_id,
                        "note" => "User ID: ".$user_id
                    );
                    $activity_model->addRow($activity);
                    if ($post['ajax']) {
                        return $this->returnJson($this->data->message);
                    } else {
                        return $this->render();
                    }
                } else {
                    $this->data->message = array(
                        "success" => false,
                        "message" => "Error creating user",
                        "type" => "error"
                    );
                    if ($post['ajax']) {
                        return $this->returnJson($this->data->message);
                    } else {
                        return $this->render();
                    }
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
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $found_users[0];
                $usersname = $found_users[0]['username'];
                $this->data->message = array(
                    "success" => true,
                    "message" => "Welcome back $usersname",
                    "type" => "success",
                    "redirect" => "/admin/dashboard"
                );
                if ($post['ajax']) {
                    return $this->returnJson($this->data->message);
                } else {
                    header("Location: /");
                    return $this->returnJson($this->data->message);
                }
            } else {
                $this->data->message = array(
                    "success" => false,
                    "message" => "Wrong Username or Password",
                    "type" => "error"
                );
                if ($post['ajax']) {
                    return $this->returnJson($this->data->message);
                } else {
                    return $this->render();
                }
            }
        } else {
            $this->data->message = array(
                "success" => false,
                "message" => "Enter both Username and Password",
                "type" => "warn"
            );
            if ($post['ajax']) {
                return $this->returnJson($this->data->message);
            } else {
                return $this->render();
            }
        }
    }

    public function logout($query = null)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        return $this->returnJson(array(
            "message" => "Goodbye",
            "success" => true
        ));
    }
}