<?php

class Cake_Model_Employees extends Core_Model_ModelDriver
{
    protected $table = 'employees';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    rank VARCHAR(255) NOT NULL
);";
    }
}