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
        $file = implode(DIRECTORY_SEPARATOR, $location) . '.php';
        try {
            if (stream_resolve_include_path($file)) {
                include $file;
            } else {
                throw new Exception('Autoloaded file/class does not exist');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}