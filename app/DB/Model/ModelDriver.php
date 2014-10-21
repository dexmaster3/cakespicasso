<?php

abstract class DB_Model_ModelDriver
{
    protected $data;
    protected $name;
    protected $conn;

    protected function startConnection()
    {
        $credentials = Core_Config::getConfig()->DB->connection_string;
        return DB_Model_Database::connect($credentials);
    }

    /**
     * @param $data Array data that matches SQL columns
     * @return int added row's ID
     */
    public function addRow($data)
    {
        try {
            if (!($data['id'] > 0)) {
                unset($data['id']);
                $this->conn = $this->startConnection();

                $values = ':' . implode(', :', array_keys($data));
                $keys = implode(', ', array_keys($data));
                $statement = $this->conn->prepare(
                    "INSERT INTO $this->table ($keys) value ($values);"
                );
                $statement->execute($data);
                $statement = $this->conn->prepare(
                    "SELECT MAX(id) FROM $this->table;"
                );
                $statement->execute();
                $row_id = $statement->fetch();
                return $row_id[0];
            } else {
                return $this->updateById($data['id'], $data);
            }
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }

    public function getAll()
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "SELECT * FROM $this->table"
            );
            $statement->execute();
            return $statement->fetchAll();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    public function findAllByColumnValue($column, $value)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "SELECT * FROM $this->table WHERE $column = '$value'"
            );
            $statement->execute();
            return $statement->fetchAll();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    public function deleteAllByColumnValue($column, $value)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "DELETE FROM $this->table WHERE $column = '$value'"
            );
            $statement->execute();
            return $statement->fetchAll();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    public function updateById($id, $data)
    {
        try {
            $this->conn = $this->startConnection();
            $new_values = array();
            foreach ($data as $datak => $datav) {
                $datav = $this->conn->quote($datav);
                array_push($new_values, "$datak=$datav");
            }
            $new_values = implode(", ", $new_values);
            $statement = $this->conn->prepare(
                "UPDATE $this->table SET $new_values WHERE id = $id"
            );
            $statement->execute();
            return $statement->fetch();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    public function findById($id)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "SELECT * FROM $this->table WHERE id = $id"
            );
            $statement->execute();
            return $statement->fetch();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    public function deleteById($id)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "DELETE FROM $this->table WHERE id = $id"
            );
            $statement->execute();
            return $statement->fetch();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }

    public function dropTable()
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "DROP TABLE $this->table"
            );
            return $statement->execute();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    public function createTable()
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare($this->getSchema());
            return $statement->execute();
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
}