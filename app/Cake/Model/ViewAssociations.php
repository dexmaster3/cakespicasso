<?php

class Cake_Model_ViewAssociations extends Core_Model_ModelDriver
{
    protected $table = 'view_associations';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    module VARCHAR(255) NOT NULL,
    view VARCHAR(255) NOT NULL,
    action VARCHAR(255) NOT NULL
);";
    }
}