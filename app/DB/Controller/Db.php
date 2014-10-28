<?php

class DB_Controller_DB extends Users_Controller_BaseAuth
{
    protected function dropandseed()
    {
        $dbseeder = new DB_Model_Seed();
        $dbseeder->initializeDatabase(true);
        return "Database dropped and re-seeded";
    }
}