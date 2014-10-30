<?php

class Renderings_Model_Rendering extends DB_Model_ModelDriver
{
    protected $table = 'renderings';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    author_id INT,
    html_string TEXT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}