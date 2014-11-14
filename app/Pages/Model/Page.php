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
    form_id INT,
    rendering_id INT,
    author_id INT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}