<?php

class DB_Controller_DB extends Core_Controller_BaseController
{
    public function dropandseed()
    {
        $dbseeder = new DB_Model_Seed();
        $dbseeder->initializeDatabase(true);
        return "Database dropped and re-seeded";
    }
}