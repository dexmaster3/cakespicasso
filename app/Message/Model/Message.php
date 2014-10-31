<?php

class Message_Model_Message extends DB_Model_ModelDriver
{
    protected $table = 'messages';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    subject VARCHAR(255),
    attachment VARCHAR(255),
    body  TEXT,
    sentfrom INT NOT NULL,
    sentto INT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}