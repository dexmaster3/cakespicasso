<?php

class Forms_Model_Form extends DB_Model_ModelDriver
{
    protected $table = 'forms';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    form_name VARCHAR(255) NOT NULL,
    form_html TEXT NOT NULL,
    author_id INT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}