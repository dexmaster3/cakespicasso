<?php

class Core_Router
{
    public static function compareConfiguredPaths()
    {
        foreach (Core_Config::getConfig() as $module_name => $module_content) {
        }
    }

    public static function getRequestPath()
    {
        $module = self::findModuleControllerAction();
        $path = null;
        if ($path === null) {
            $path = self::findAltModuleName();
        }
        return $path;
    }

    private function findModuleControllerAction()
    {
        $request_parts = Core_Request::getRequest()->parsed_url;
        $request_query = Core_Request::getRequest()->parsed_query;
        $module = null;
        foreach (Core_Config::getConfig() as $configk => $configv) {
            if (isset($configv->alt_name)) {
                if (strtolower($configv->alt_name) === strtolower($request_parts['module'])) {
                    $location = array(
                        'module' => $request_parts['module'],
                        'controller' => $request_parts['controller'],
                        'action' => $request_parts['action'],
                        'params' => $request_query
                    );
                }
            } else {
                if (strtolower($configk) === strtolower($request_parts['module'])) {
                    $location = array(
                        'module' => $request_parts['module'],
                        'controller' => $request_parts['controller'],
                        'action' => $request_parts['action'],
                        'params' => $request_query
                    );
                }
            }
        }
        if (is_null($location)) {
            //ToDo: handle defaults routing for ie: index?
        }
        return $location;
    }

    private function findAltModuleName()
    {
        $moduleConfigs = $this->configs->getModuleConfigs();
        $requestUrl = $this->request->getParsedUrl();
        foreach ($moduleConfigs as $config) {
            if (($requestUrl[0] === $config->module->altModName) || ($requestUrl[0] === $config->module->name)) {
                $controller = $config->module->name . '_' . $requestUrl[1] . $config->module->controllersuffix;
                $action = $requestUrl[2];
                return array($controller, $action);
            }
        }
        return null;
    }
}