<?php

class Users_Model_Note extends DB_Model_ModelDriver
{
    protected $table = 'notes';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    body VARCHAR(255),
    author_id INT,
    parent_note INT,
    profile_id INT,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}