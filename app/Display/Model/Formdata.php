<?php

class Display_Model_Formdata extends DB_Model_ModelEAVDriver
{
    protected $table = 'formdatas';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    entity INT NOT NULL,
    attribute VARCHAR(255) NOT NULL,
    value TEXT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}