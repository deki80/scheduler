<?php

namespace LLT\Init;


class Router {
    private static $controller_obj;

    private static $controller = null;
    private static $method = null;
    private static $param = null;

    public static function route($url = null)
    {
        $url = explode('/', $url);

        if(empty($url[1]) || !isset($url[1])) {
            self::$controller = '\\LLT\\Controllers\\PageController';
            self::$method = 'index';
        }else{
            self::$controller = '\\LLT\\Controllers\\'.ucfirst($url[1]).'Controller';
            $method_from_url = empty($url[2]) ? 'index' : strtolower($url[2]);
            $param = empty($url[3]) ? null : $url[3];
            self::$method = $method_from_url;
            self::$param = $param;
        }

        if(class_exists(self::$controller)) {
            self::$controller_obj = new self::$controller(self::$method, self::$param);
        }else{
            $view = new View();
            $view->load('404');
        }
    }
}
