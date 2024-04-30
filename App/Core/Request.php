<?php

namespace App\Core;

class Request
{
    private $routeParams=[];
    private $params;
    private $method;
    private $agent;
    private $uri;
    private $ip;

    public function __construct()
    {
        $this->params=$_REQUEST;
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function __get($key)
    {
        return $this->input($key);
    }
    // Class Apis
    public function getParams()
    {
        return $this->params;
    }

    public function getMethod()
    {
        return (strtoupper($this->method));
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function ip()
    {
        return $this->ip;
    }

    public function setRouteParams($key, $value)
    {
        $this->routeParams[$key] = $value;
    }

    public function getRouteParam($key)
    {
        return $this->routeParams[$key];
    }

    public function getRouteParams($key)
    {
        return $this->routeParams;
    }
    // End Class Api

    public function input(string $key) : string
    {
        return $this->params[$key] ?? 'null';
    }

    public function exist(string $key) : bool
    {
        return isset($this->params[$key]);
    }

    public function redirect(string $route)
    {
        header("Location:" . site_url($route));
    }

    public function go()
    {
        return $_ENV['BASE_URL'].substr($this->uri,1);
    }
}