<?php

abstract class DB_Model_ModelEAVDriver
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
     * @param $data Array any sort of data for the EAV table
     * @return int added row's ID
     */
    public function addRow($data)
    {
        try {
            $this->conn = $this->startConnection();
            $max_entity_st = $this->conn->prepare(
                "SELECT MAX(entity) FROM $this->table;"
            );
            $max_entity_st->execute();
            $max_entity = $max_entity_st->fetch();
            $max_entity_no = $max_entity[0] + 1;

            $total_data = array();
            $insert_data = array();
            $n = 0;
            foreach ($data as $data_item_k => $data_item_v) {
                $total_data[] = "(:entity$n, :attribute$n, :value$n)";
                $insert_data["entity$n"] = $max_entity_no;
                $insert_data["attribute$n"] = $data_item_k;
                $insert_data["value$n"] = $data_item_v;
                $n++;
            }
            if (!empty($insert_data)) {
                $ready_data = implode(', ', $total_data);
                $stmt = $this->conn->prepare(
                    "INSERT INTO $this->table (entity, attribute, value) VALUES $ready_data;"
                );
                $stmt->execute($insert_data);
                return true;
            } else {
                return false;
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
            $entities = $statement->fetchAll(PDO::FETCH_ASSOC);
            $ret_entities = array();
            foreach ($entities as $entity) {
                if (array_key_exists($entity['entity'], $ret_entities)) {
                    $ret_entities[$entity['entity']][$entity['attribute']] = $entity['value'];
                } else {
                    $ret_entities[$entity['entity']] = array(
                        $entity['attribute'] => $entity['value']
                    );
                }
            }
            return $ret_entities;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }

    public function getAllWhereAttributeIsValue($attrib, $value)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "SELECT * FROM $this->table"
            );
            $statement->execute();
            $entities = $statement->fetchAll(PDO::FETCH_ASSOC);
            $ret_entities = array();
            foreach ($entities as $entity) {
                if (array_key_exists($entity['entity'], $ret_entities)) {
                    $ret_entities[$entity['entity']][$entity['attribute']] = $entity['value'];
                } else {
                    $ret_entities[$entity['entity']] = array(
                        $entity['attribute'] => $entity['value']
                    );
                }
            }
            $final_entities = array();
            foreach ($ret_entities as $ret_entity) {
                if (isset($ret_entity[$attrib]) && $ret_entity[$attrib] == $value) {
                    array_push($final_entities, $ret_entity);
                }
            }
            return $final_entities;
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
                "SELECT * FROM $this->table WHERE entity = $id"
            );
            $statement->execute();
            $entity = $statement->fetchAll(PDO::FETCH_ASSOC);
            $ret_entity = array();
            foreach ($entity as $eav) {
                $ret_entity[$eav['attribute']] = $eav['value'];
            }
            return $ret_entity;
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
                "DELETE FROM $this->table WHERE entity = $id"
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