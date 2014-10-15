<?php

abstract class Core_Model_ModelDriver
{
    protected $data;
    protected $name;
    protected $conn;

    protected function startConnection()
    {
        $credentials = Core_Config::getConfig()->Core->connection_string;
        return Core_Database::connect($credentials);
    }

    public function addRow($data)
    {
        $this->conn = $this->startConnection();

        $table_keys = array_keys($data);
        $table_values = implode(', ', $table_keys);
        foreach ($table_keys as &$key) {
            $key = ":$key";
        }
        $table_keys = implode(', ', $table_keys);

        $statement = $this->conn->prepare(
            "INSERT INTO $this->table ($table_values) value ($table_keys);
LAST_INSERT_ID();"
        );
        $statement->execute($data);
        return $statement->fetch();
    }

    public function getAll()
    {
        $this->conn = $this->startConnection();
        $statement = $this->conn->prepare(
            "SELECT * FROM $this->table"
        );
        $statement->execute();
        return $statement->fetchAll();
    }
    public function findAllByColumnValue($column, $value)
    {
        $this->conn = $this->startConnection();
        $statement = $this->conn->prepare(
            "SELECT * FROM $this->table WHERE $column = '$value'"
        );
        $statement->execute();
        return $statement->fetchAll();
    }
    public function deleteAllByColumnValue($column, $value)
    {
        $this->conn = $this->startConnection();
        $statement = $this->conn->prepare(
            "DELETE * FROM $this->table WHERE $column = '$value'"
        );
        $statement->execute();
        return $statement->fetchAll();
    }

    public function findById($id)
    {
        $this->conn = $this->startConnection();
        $statement = $this->conn->prepare(
            "SELECT * FROM $this->table WHERE id = $id"
        );
        $statement->execute();
        return $statement->fetch();
    }
    public function deleteById($id)
    {
        $this->conn = $this->startConnection();
        $statement = $this->conn->prepare(
            "DELETE FROM $this->table WHERE id = $id"
        );
        $statement->execute();
        return $statement->fetch();
    }

    public function dropTable()
    {
        $this->conn = $this->startConnection();
        $statement = $this->conn->prepare(
            "DROP TABLE $this->table"
        );
        return $statement->execute();
    }
    public function createTable()
    {
        $this->conn = $this->startConnection();
        $statement = $this->conn->prepare($this->getSchema());
        return $statement->execute();
    }
}