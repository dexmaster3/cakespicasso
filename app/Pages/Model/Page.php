<?php

class Pages_Model_Page extends DB_Model_ModelDriver
{
    protected $table = 'pages';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    page_name VARCHAR(255) NOT NULL,
    page_url VARCHAR(255) NOT NULL,
    page_html TEXT NOT NULL,
    rendering_id INT,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}