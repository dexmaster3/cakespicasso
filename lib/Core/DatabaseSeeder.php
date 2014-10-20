<?php

class Core_DatabaseSeeder
{
    protected $DBH;

    public function seedDatabase()
    {
        $credentials = Core_Config::getConfig()->Core->connection_string;
        $this->DBH = Core_Database::connect($credentials);

        $models = array(
            'Core_Model_CustomRoutes',
            'Pages_Model_Pages',
            'Layouts_Model_Layout'
        );

        foreach($models as $model) {
            $modelc = new $model;
            $modelc->dropTable();
            $modelc->createTable();
        }
    }
}