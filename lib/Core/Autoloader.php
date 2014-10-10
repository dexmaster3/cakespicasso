<?php

class Core_Autoloader
{
    public function register($paths)
    {
        $this->setPath($paths);
        $this->setAutoloader();
    }
    protected function setAutoloader()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }
    protected function setPath($paths)
    {
        $include_path = explode(PATH_SEPARATOR, get_include_path());
        foreach ($paths as $path) {
            array_push($include_path, ROOT . DIRECTORY_SEPARATOR . $path);
        }
        $new_include_path = implode(PATH_SEPARATOR, $include_path);
        set_include_path($new_include_path);
    }
    /**
     * Function used by the php spl_autoloader
     * @param object $className Class name to be auto-loaded
     */
    public function loadClass($className)
    {
        $className = ltrim($className, '\\');
        $location = explode('_', $className);
        $paths = explode(PATH_SEPARATOR, get_include_path());
        foreach ($paths as $path) {
            $file = $path . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $location) . '.php';
            if (is_file($file)) {
                require_once $file;
            }
        }
    }
}