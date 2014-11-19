<?php

class Analytics_Model_Click extends DB_Model_ModelDriver
{
    protected $table = 'clicks';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    x SMALLINT(4) unsigned NOT NULL,
    y SMALLINT(4) unsigned NOT NULL,
    location varchar(255) NOT NULL,
    username varchar(255),
    user_id INT,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }

    //These felt a little too specific to leave in the ModelDriver.php --but they could be moved there
    public function findAllByAnyValueLimitCount($value)
    {
        try {
            $this->conn = $this->startConnection();
            $columns = $this->conn->query("SHOW COLUMNS FROM $this->table");
            $column_list = array();
            foreach ($columns as $column) {
                $column_sql = $column['Field'] . " LIKE '%$value%'";
                array_push($column_list, $column_sql);
            }
            $sql_search = "(".implode(" or ", $column_list).")";
            $statement = $this->conn->prepare(
                "SELECT COUNT(*) FROM $this->table WHERE $sql_search;"
            );
            $statement->execute();
            return $statement->fetch(PDO::FETCH_BOTH);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }

    public function getNumStartingOnOrderByCount($order_column)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "SELECT COUNT(*) FROM $this->table ORDER BY $order_column;"
            );
            $statement->execute();
            return $statement->fetch(PDO::FETCH_BOTH);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
}