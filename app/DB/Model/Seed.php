<?php

class DB_Model_Seed extends Core_Model_ModelDriver
{
    public function initializeDatabase()
    {
        $config = Core_Config::getConfig();
        $dbconn = $config->Core->connection_string;
        $DBH = new PDO("mysql:host=$dbconn->host", $dbconn->user, $dbconn->password);

        $DBH->exec(
            "CREATE DATABASE IF NOT EXISTS $dbconn->database;"
        );

        foreach ($config as $modconfig => $moddata) {
            if (isset($moddata->model_seeds)) {
                foreach ($moddata->model_seeds as $model) {
                    $modelinstance = new $model;
                    $modelinstance->dropTable();
                    $modelinstance->createTable();
                }
            }
        }

        $config->Core->createdb = false;
        $new_core_config_file = json_encode($config->Core, JSON_PRETTY_PRINT);
        $write_success = file_put_contents(ROOT . '/config.json', $new_core_config_file);
        return $write_success;
    }
}