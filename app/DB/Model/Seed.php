<?php

class DB_Model_Seed extends DB_Model_ModelDriver
{
    public function initializeDatabase($runanyway = false)
    {
        $config = Core_Config::getConfig();
        if ($config->DB->createdb || $runanyway) {
            $dbconn = $config->DB->connection_string;
            $DBH = new PDO("mysql:host=$dbconn->host", $dbconn->user, $dbconn->password);

            $DBH->exec(
                "CREATE DATABASE IF NOT EXISTS $dbconn->database;"
            );

            foreach ($config as $modconfig => $moddata) {
                if (isset($moddata->model_seeds)) {
                    foreach ($moddata->model_seeds as $modelk => $modelv) {
                        $modelinstance = new $modelk;
                        $modelinstance->dropTable();
                        $modelinstance->createTable();
                        foreach ($modelv as $row) {
                            $row_array = (array)$row;
                            $modelinstance->addRow($row_array);
                        }
                    }
                }
            }

            $config->DB->createdb = false;
            //this is to wrap the json in a named key (module name)
            $core_config = null;
            $core_config->DB = $config->DB;
            $new_core_config_file = json_encode($core_config, JSON_PRETTY_PRINT);
            $write_success = file_put_contents(ROOT . '/app/DB/config.json', $new_core_config_file);
            return $write_success;
        } else {
            return false;
        }
    }
}