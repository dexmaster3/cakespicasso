<?php

class DB_Model_Database
{
    static private $initialized = false;
    static private $DBH;

    static public function connect($dbconn)
    {
        if (!self::$initialized) {
            self::$initialized = true;
            self::setConn($dbconn);
        }
        return self::$DBH;
    }
    static public function setConn($dbconn)
    {
        try {
            self::$DBH = new PDO("mysql:host=$dbconn->host;dbname=$dbconn->database", $dbconn->user, $dbconn->password);
            return self::$DBH;
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    static public function killConn()
    {
        try {
            self::$DBH = null;
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
}