<?php

class Layouts_Model_Layout extends DB_Model_ModelDriver
{
    protected $table = 'layouts';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    layout_name VARCHAR(255) NOT NULL,
    author_id INT,
    layout_content TEXT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}