<?php

class Core_Database
{
    static $DBH;
    static function connect($dbconn)
    {
        try {
            self::$DBH = new PDO("mysql:host=$dbconn[0];dbname=$dbconn[1]", $dbconn[2], $dbconn[3]);
        }
        catch(PDOException $ex) {
            echo $ex->getMessage();
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