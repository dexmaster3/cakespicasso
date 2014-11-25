<?php

class Users_Model_User extends DB_Model_ModelDriver
{
    protected $table = 'users';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(255) NOT NULL,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    about TEXT,
    avatar VARCHAR(255),
    avatar_crop VARCHAR(255),
    birthday DATETIME,
    gender VARCHAR(255),
    address VARCHAR(255),
    phone VARCHAR(255),
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (username),
    UNIQUE (email)
);";
    }

    //Need to extend standard Get methods to always populate the right avatar
    public function getAllUsers()
    {
        $ret_users = array();
        $users = $this->getAll();
        foreach ($users as $user) {
            if (!empty($user['avatar_crop'])) {
                $user['avatar'] = $user['avatar_crop'];
            } elseif (!empty($user['avatar'])) {

            } else {
                $user['avatar'] = "";
            }
            array_push($ret_users, $user);
        }
        return $ret_users;
    }
    public function getUser($user_id)
    {
        $user = $this->findById($user_id);
        if (!empty($user['avatar_crop'])) {
            $user['avatar'] = $user['avatar_crop'];
        } elseif (!empty($user['avatar'])) {

        } else {
            $user['avatar'] = "";
        }
        return $user;
    }
}