<?php

class Core_Model_CustomRoutes extends Core_Model_ModelDriver
{
    protected $table = 'custom_routes';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    url VARCHAR(255) NOT NULL,
    module VARCHAR(255) NOT NULL,
    controller VARCHAR(255) NOT NULL,
    action VARCHAR(255) NOT NULL,
    remote_id INT NOT NULL
);";
    }
}