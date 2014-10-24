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
        $app_config = Core_Config::getConfig();
        $app_request = Core_Request::getRequest();

        $config_match = self::findConfigExactMatch($app_config, $app_request);
        $db_match = self::findDbExactMatch($app_config, $app_request);
        $use_request = self::useModuleControllerAction($app_config, $app_request);

        if (isset($config_match)) {
            self::$location = $config_match;
        } elseif (isset($db_match)) {
            self::$location = $db_match;
        } elseif (isset($use_request)) {
            self::$location = $use_request;
        }
        self::setDefaultIndex();
    }

    private function findDbExactMatch($app_config, $app_request)
    {
        try {
            $request_uri = $app_request->request_uri;
            $routes = new DB_Model_CustomRoutes();
            $all_routes = $routes->findAllByColumnValue('url', $request_uri);
            foreach ($all_routes as $route) {
                if ($route['url'] === $request_uri) {
                    $location = array(
                        'module' => ucfirst($route['module']),
                        'controller' => ucfirst($route['controller']),
                        'action' => $route['action'],
                        'params' => $route['remote_id']
                    );
                    return $location;
                }
            }
            return null;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return null;
        }
    }

    private function findConfigExactMatch($app_config, $app_request)
    {
        $request_uri = $app_request->request_uri;
        $request_query = $app_request->parsed_query;
        foreach ($app_config as $configk => $configv) {
            if (isset($configv->custom_routes)) {
                foreach ($configv->custom_routes as $routek => $routev) {
                    //ToDo find a better way to handle root requests
                    if (strtolower($routek) === strtolower($request_uri)) {
                        $location = array(
                            'module' => ucfirst($routev->module),
                            'controller' => ucfirst($routev->controller),
                            'action' => $routev->action,
                            'params' => $request_query
                        );
                        return $location;
                    }
                }
            }
        }
        return null;
    }

    private function useModuleControllerAction($app_config, $app_request)
    {
        $request_parts = $app_request->parsed_url;
        $request_query = $app_request->parsed_query;
        foreach ($app_config as $configk => $configv) {
            if (isset($configv->alt_name)) {
                //Use alternate name
                if (strtolower($configv->alt_name) === strtolower($request_parts['module'])) {
                    $location = array(
                        'module' => ucfirst($configk),
                        'controller' => ucfirst($request_parts['controller']),
                        'action' => $request_parts['action'],
                        'params' => $request_query
                    );
                    return $location;
                }
            } else {
                //Use regular Module name
                if (strtolower($configk) === strtolower($request_parts['module'])) {
                    $location = array(
                        'module' => ucfirst($configk),
                        'controller' => ucfirst($request_parts['controller']),
                        'action' => $request_parts['action'],
                        'params' => $request_query
                    );
                    return $location;
                }
            }
        }
        return null;
    }

    private function setDefaultIndex()
    {
        if (empty(self::$location['module'])) {
            self::$location['module'] = 'Index';
        }
        if (empty(self::$location['controller'])) {
            self::$location['controller'] = 'Index';
        }
        if (empty(self::$location['action'])) {
            self::$location['action'] = 'Index';
        }
    }
}