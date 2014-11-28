<?php

class Users_Model_Note extends DB_Model_ModelDriver
{
    protected $table = 'notes';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    body VARCHAR(255),
    author_id INT,
    parent_note INT,
    profile_id INT,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }
    public function findAllByColumnValueWhereNoParent($column, $value)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "SELECT * FROM $this->table WHERE $column = '$value' AND parent_note = 0;"
            );
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
}