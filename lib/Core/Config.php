<?php

class Core_Config
{
    private static $initialized = false;
    private static $config_names = '/*/config.json';
    private static $configs;

    public static function getConfig()
    {
        if (!self::$initialized) {
            self::$initialized = true;
            self::setConfig();
        }
        return self::$configs;
    }

    private function setConfig()
    {
        //ToDo: maybe possible to use include path here, but when two files, path only returns one (default functionality?)
        try {
            foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
                $config = glob($path . self::$config_names);
                if (!empty($config)) {
                    foreach ($config as $single_config) {
                        $config_data = json_decode(file_get_contents($single_config));
                        foreach ($config_data as $key => $val) {
                            self::$configs->$key = $val;
                        }
                    }
                }
            }
        }
        catch (Exception $ex) {
            echo $ex->getMessage();
            echo "Check that your config files are valid";
        }
    }
}