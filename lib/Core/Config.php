<?php

class Core_Config
{
    private static $initialized = false;
    private static $config_names = 'app/*/config.json'; //Glob files from include paths so that this isn't hardcoded
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
        $config = glob(ROOT . DIRECTORY_SEPARATOR . self::$config_names);
        if ($config !== null) {
            $config_data = json_decode(file_get_contents($config[0]));
            foreach ($config_data as $key => $val) {
                self::$configs->$key = $val;
            }
        }
    }
}