<?php

class Message_Model_Message extends DB_Model_ModelDriver
{
    protected $table = 'messages';

    protected function getSchema()
    {
        return "CREATE TABLE $this->table
(
    message_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    subject VARCHAR(255),
    attachment VARCHAR(255),
    body  TEXT,
    sentfrom INT NOT NULL,
    sentto INT NOT NULL,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
    }

    public function findAllMessagesForUserId($userid)
    {
        try {
            $this->conn = $this->startConnection();
            $statement = $this->conn->prepare(
                "SELECT * FROM $this->table LEFT JOIN users ON messages.sentfrom = users.id WHERE sentto = $userid;"
            );
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
}