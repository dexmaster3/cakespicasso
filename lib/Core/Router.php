<?php

class Core_Router
{
    private static $location;
    private static $initialized = false;

    public static function getRoute()
    {
        if (!self::$initialized) {
            self::$initialized = true;
            self::getRequestPath();
        }
        return self::$location;
    }

    private static function getRequestPath()
    {
        $location = self::findModuleControllerAction();
        if (is_null($location['module'])) {
            $location['module'] = 'Index';
        } elseif (is_null($location['controller'])) {
            $location['controller'] = 'Index';
        } elseif (is_null($location['action'])) {
            $location['action'] = 'index';
        }
        self::$location = $location;
    }

    private function findModuleControllerAction()
    {
        $request_parts = Core_Request::getRequest()->parsed_url;
        $request_query = Core_Request::getRequest()->parsed_query;
        $location = null;
        foreach (Core_Config::getConfig() as $configk => $configv) {
            if (isset($configv->alt_name)) {
                if (strtolower($configv->alt_name) === strtolower($request_parts['module'])) {
                    $location = array(
                        'module' => $configk,
                        'controller' => $request_parts['controller'],
                        'action' => $request_parts['action'],
                        'params' => $request_query
                    );
                }
            } else {
                if (strtolower($configk) === strtolower($request_parts['module'])) {
                    $location = array(
                        'module' => $configk,
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