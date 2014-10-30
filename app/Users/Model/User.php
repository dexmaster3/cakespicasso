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
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    about  TEXT,
    avatar VARCHAR(255),
    birthday DATETIME,
    gender VARCHAR(255),
    address VARCHAR(255),
    phone VARCHAR(255),
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (username),
    UNIQUE (email)
);";
    }
}