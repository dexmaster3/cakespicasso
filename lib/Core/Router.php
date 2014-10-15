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
        if (is_null($location)) {
            $location = self::findModuleControllerActionDatabase();
        }
        if (empty($location['module'])) {
            $location['module'] = 'Index';
        } elseif (empty($location['controller'])) {
            $location['controller'] = 'Index';
        } elseif (empty($location['action'])) {
            $location['action'] = 'index';
        }
        self::$location = $location;
    }
    //ToDo: this will be passed a modules route which contains definitions
    private function findModuleControllerActionDatabase()
    {
        $routes = new Core_Model_CustomRoutes();
        $all_routes = $routes->getAll();
        foreach($all_routes as $route) {
            if ($route['url'] === Core_Request::getRequest()->request_uri) {
                $location = array(
                    'module' => ucfirst($route['module']),
                    'controller' => ucfirst($route['controller']),
                    'action' => $route['action'],
                    'params' => Core_Request::getRequest()->parsed_query
                );
                return $location;
            }
        }
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
                        'module' => ucfirst($configk),
                        'controller' => ucfirst($request_parts['controller']),
                        'action' => $request_parts['action'],
                        'params' => $request_query
                    );
                }
            } else {
                if (strtolower($configk) === strtolower($request_parts['module'])) {
                    $location = array(
                        'module' => ucfirst($configk),
                        'controller' => ucfirst($request_parts['controller']),
                        'action' => $request_parts['action'],
                        'params' => $request_query
                    );
                }
            }
            if (isset($configv->custom_routes)) {
                foreach($configv->custom_routes as $routek => $routev) {
                    if (strtolower($routek) === strtolower(Core_Request::getRequest()->request_uri)) {
                        $location = array(
                            'module' => ucfirst($routev->module),
                            'controller' => ucfirst($routev->controller),
                            'action' => $routev->action,
                            'params' => $request_query
                        );
                    }
                }
            }
        }
        return $location;
    }
    /**
     * Use magic getters/setters to avoid not set exceptions....
     * @param null $key
     *
     * @return $request->key
     */
    public function __get($key = null){
        return isset(self::$location->$key) ? self::$location->$key : null;
    }
}