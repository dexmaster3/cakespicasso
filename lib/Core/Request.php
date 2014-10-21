<?php

class Core_Request
{
    private static $request;
    private static $initialized = false;

    public static function getRequest()
    {
        if (!self::$initialized) {
            self::$initialized = true;
            self::setRequest();
        }
        return self::$request;
    }

    private static function setRequest()
    {
        self::$request->request_uri = ltrim($_SERVER['REQUEST_URI'], '/');
        self::$request->query = $_SERVER['QUERY_STRING'];
        self::$request->method = $_SERVER['REQUEST_METHOD'];
        self::$request->host = $_SERVER['HTTP_HOST'];
        self::$request->parsed_url = self::parseUrl();
        self::$request->parsed_query = self::parseQuery();
        self::$request->post = self::parsePost();
    }

    private function parsePost()
    {
        if (!empty($_POST)) {
            $post_content = array();
            foreach ($_POST as $postk => $postv) {
                $post_content[$postk] = $postv;
            }
            return $post_content;
        } else {
            return null;
        }
    }

    private function parseUrl()
    {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);
        $url_only = $parsed_url['path'];
        $url = explode('/', ltrim($url_only, '/'));
        $url_parts = array(
            "module" => $url[0],
            "controller" => $url[1],
            "action" => $url[2]
        );
        return $url_parts;
    }

    private function parseQuery()
    {
        parse_str($_SERVER['QUERY_STRING'], $parsed_query);
        return $parsed_query;
    }
}