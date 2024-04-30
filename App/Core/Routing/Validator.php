<?php
namespace App\Core\Routing;
use App\Core\Request;

class Validator
{
    public function validateRoute(array $route)
    {
        if(empty($route))
            notFound();
        return $this->validateAction($route);
    }

    public function validateAction(array $route) : array
    {
        if(is_null($route['action'] || empty($route['action'])))
            throw new Exception("action not defined"); 
        if(is_callable($route['action']))
            $route['action']();
        if(is_string($route['action']))
            return (explode('@', $route['action']));
        if(is_array($route['action']))
            return $route;
    }

    
}