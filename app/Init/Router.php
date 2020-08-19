<?php

namespace LLT\Init;


class Router
{
    private $requestUri;
    private $requestMethod;

    public function __construct()
    {
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function get(string $route, string $dispatchTo)
    {
        if($this->requestMethod === 'get' && $this->isPathRegistered($route)) {
            $handler = '\\LLT\\Controllers\\' . $dispatchTo;
            $handler();
        }else{
            echo "pogrešna putanja";
        }
    }

    private function isPathRegistered($route)
    {
        return $this->requestUri == $route ? true : false;
    }

    private function dispatch(string $dispatchTo)
    {
        $handle = explode('::', $dispatchTo);
    }


}