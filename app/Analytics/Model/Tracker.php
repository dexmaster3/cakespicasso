<?php

class Analytics_Model_Tracker extends DB_Model_ModelDriver
{
    protected $table = 'trackers';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `as` VARCHAR(255),
    city VARCHAR(255),
    country VARCHAR(255),
    countryCode VARCHAR(255),
    isp VARCHAR(255),
    lat VARCHAR(255),
    lon VARCHAR(255),
    org VARCHAR(255),
    `query` VARCHAR(255),
    message VARCHAR(255),
    `status` VARCHAR(255),
    region VARCHAR(255),
    regionName VARCHAR(255),
    timezone VARCHAR(255),
    zip VARCHAR(255),
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
}