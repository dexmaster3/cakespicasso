<?php

class Media_Model_Media extends DB_Model_ModelDriver
{
    protected $table = 'media';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    original_name VARCHAR(255),
    file_name VARCHAR(255) NOT NULL,
    full_path VARCHAR(255),
    server_full_path VARCHAR(255),
    author_id INT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}