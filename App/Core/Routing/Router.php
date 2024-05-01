<?php
namespace App\Core\Routing;

use App\Core\Request;
use App\Core\Routing\Route;
use App\Core\Routing\Validator;

class Router
{

    private $request;
    private $routes;
    private $current_route;
    private $validator;

    const BASE_CONTROLLER = 'App\Controllers\\';

    public function __construct(object $request)
    {
        $this->request=$request;
        $this->routes = Route::all();
        $this->validator = new Validator();
        $this->current_route = $this->findRoute();
    }

    public function findRoute() : array
    {
        foreach($this->routes as $route){
            // if($request->getMethod() == $route['methods'][0]){
            //     return $route;
            // }
            if($this->is_regex_match($route['uri'])){
                return $route;
            }
        }
        return [];
    }

    private function is_regex_match($route) : bool
    {
        $pattern = "/^" . str_replace(['/','{','}'],['\/','(?<','>[-%\w]+)'],$route) ."$/";

        if(!preg_match($pattern, $this->request->getUri(), $matches)){
            return false;
        }
        foreach($matches as $key => $value){
            if(!is_int($key)){
                $this->request->setRouteParams($key, $value);
            }
        }
        return true;
    }

    public function handle() : void
    {
        $route=$this->validator->validateRoute($this->current_route);
        $className = self::BASE_CONTROLLER . $route[0];
        $method = $route[1];
        if(!class_exists($className))
            throw new \Exception("Class $className Not Exist");
        if(!method_exists($className,$method))
            throw new \Exception("Method $method Not Exist");
        $controller = new $className($this->request);
        $controller->$method($this->request);
    }
}