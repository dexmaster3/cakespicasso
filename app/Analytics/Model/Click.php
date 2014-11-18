<?php

class Analytics_Model_Click extends DB_Model_ModelDriver
{
    protected $table = 'clicks';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    x SMALLINT(4) unsigned NOT NULL,
    y SMALLINT(4) unsigned NOT NULL,
    location varchar(255) NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}