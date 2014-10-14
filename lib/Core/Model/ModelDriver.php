<?php

abstract class Core_Model_ModelDriver
{
    private $data;
    private $name;
    private $conn;

    public function get($table)
    {
        $this->conn = Core_Database::connect(array('localhost', 'cakespicasso', 'dexter', 'dexter'));
        $STH = $this->conn->prepare("SELECT * FROM $table");
        $STH->execute();
        return $STH->fetch();
    }
}