<?php

class Analytics_Model_ActivityLog extends DB_Model_ModelDriver
{
    protected $table = 'activity';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(255),
    description VARCHAR(255),
    note VARCHAR(255),
    type VARCHAR(255),
    author_id INT,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}