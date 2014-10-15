<?php

class Core_Database
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
    static public function seedDatabase($dbconn)
    {
        $credentials = Core_Config::getConfig()->Core->connection_string;
        $DBH = self::connect($credentials);
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