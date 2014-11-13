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
            if (!isset($data['id']) || !($data['id'] > 0)) {
                unset($data['id']);
                $this->conn = $this->startConnection();
                $columns = $this->conn->query("SHOW COLUMNS FROM $this->table");
                $allowed_fields = array();
                $filtered_data = array();
                foreach ($columns as $column) {
                    array_push($allowed_fields, $column['Field']);
                }
                foreach ($data as $datak => $datav) {
                    if (in_array($datak, $allowed_fields)) {
                        $filtered_data[$datak] = $datav;
                    }
                }
                $values = ':' . implode(', :', array_keys($filtered_data));
                $keys = implode(', ', array_keys($filtered_data));
                $statement = $this->conn->prepare(
                    "INSERT INTO $this->table ($keys) value ($values);"
                );
                $state_ran = $statement->execute($filtered_data);
                $statement = $this->conn->prepare(
                    "SELECT MAX(id) FROM $this->table;"
                );
                $statement->execute();
                $row_id = $statement->fetch();
                return $row_id[0];
            } else {
                return $this->updateById($data['id'], $data);
            }
        } catch (PDOException $ex) {
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
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
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
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
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
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }

    public function updateById($id, $data)
    {
        try {
            unset($data['id']);
            $this->conn = $this->startConnection();
            $columns = $this->conn->query("SHOW COLUMNS FROM $this->table");
            $new_values = array();
            $allowed_fields = array();
            foreach ($columns as $column) {
                array_push($allowed_fields, $column['Field']);
            }
            foreach ($data as $datak => $datav) {
                $datav = $this->conn->quote($datav);
                if (in_array($datak, $allowed_fields)) {
                    array_push($new_values, "$datak=$datav");
                }
            }
            $new_values = implode(", ", $new_values);
            $statement = $this->conn->prepare(
                "UPDATE $this->table SET $new_values WHERE id = $id"
            );
            $statement->execute();
            $rows_affected = $statement->rowCount();
            return $id;
        } catch (PDOException $ex) {
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
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
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
            return $statement->rowCount();
        } catch (PDOException $ex) {
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
        } catch (PDOException $ex) {
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
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
}