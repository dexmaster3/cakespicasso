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
        self::$request = new stdClass();
        self::$request->request_uri = self::requestUri();
        self::$request->query = $_SERVER['QUERY_STRING'];
        self::$request->method = $_SERVER['REQUEST_METHOD'];
        self::$request->host = $_SERVER['HTTP_HOST'];
        self::$request->parsed_url = self::parseUrl();
        self::$request->parsed_query = self::parseQuery();
        self::$request->post = self::parsePost();
    }

    private static function requestUri()
    {
        $uri = ltrim($_SERVER['REQUEST_URI'], '/');
        $uri = explode("?", $uri);
        if (empty($uri[0])) {
            $uri = "ROOT_REQUEST";
            return $uri;
        } else {
            return $uri[0];
        }
    }

    private static function parsePost()
    {
        if (!empty($_POST)) {
            $post_content = array();
            foreach ($_POST as $postk => $postv) {
                $post_content[$postk] = $postv;
            }
            return $post_content;
        } elseif ($json = file_get_contents("php://input")) {
            $json_dec = json_decode($json, true);
            return $json_dec;
        } else {
            return null;
        }
    }

    private static function parseUrl()
    {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);
        $url_only = $parsed_url['path'];
        $url = explode('/', ltrim($url_only, '/'));
        if (empty($url[0]))
            $url[0] = null;
        if (empty($url[1]))
            $url[1] = null;
        if (empty($url[2]))
            $url[2] = null;
        $url_parts = array(
            "module" => $url[0],
            "controller" => $url[1],
            "action" => $url[2]
        );
        if (empty($url[0])) {
            $url_parts = false;
        }
        return $url_parts;
    }

    private static function parseQuery()
    {
        parse_str($_SERVER['QUERY_STRING'], $parsed_query);
        return $parsed_query;
    }
}