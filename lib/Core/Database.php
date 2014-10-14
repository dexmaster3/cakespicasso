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
    static public function setConn($dbconn)
    {
        try {
            self::$DBH = new PDO("mysql:host=$dbconn[0];dbname=$dbconn[1]", $dbconn[2], $dbconn[3]);
            return self::$DBH;
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }
    static function insert($data)
    {
        $data = array('controller' => 'Home', 'view' => 'Away', 'action' => 'index');
        $STH = self::$DBH->prepare("insert into controller_views (controller, view, action) value (:controller, :view, :action)");
        $STH->execute($data);
        self::$DBH = null;
    }
}