<?php

namespace Routes;
use Routes\Route;

class Router {
    public array $routes;
    public array $controllers;

    public function __construct(array $controllers)
    {
        $this->routes = [];
        $this->controllers = $controllers;
    }

    public function addRoute(
        string $path, 
        string $controller, 
        string $method = "index", 
        string $requestMethod
    ) {
        $this->routes[] = new Route(
            $controller,
            $method,
            $requestMethod,
            \Utils\hasNumParam($path) 
                ? \Utils\addNumberRegex($path) 
                : \Utils\makeRegexRoute($path)
        );
    }

    public function get(
        string $path, 
        string $controller, 
        string $method = "index", 
    ){
        $this->addRoute(
            $path,
            $controller,
            $method,
            "GET"
        );
    }

    public function post(
        string $path, 
        string $controller, 
        string $method = "index", 
    ){
        $this->addRoute(
            $path,
            $controller,
            $method,
            "POST"
        );
    }

    public function put(
        string $path, 
        string $controller, 
        string $method = "index", 
    ){
        $this->addRoute(
            $path,
            $controller,
            $method,
            "PUT"
        );
    }

    public function delete(
        string $path, 
        string $controller, 
        string $method = "index", 
    ){
        $this->addRoute(
            $path,
            $controller,
            $method,
            "DELETE"
        );
    }

    public function handleRequest($server){
        $route = $this->findRoute($server);      
        $controller = $this->getControllerInstace($route->controller);        
        $controller->{$route->method}($_SERVER, $route);
    }

    public function findRoute($server){
        $method = $server['REQUEST_METHOD'];
        $uri = substr($server['REQUEST_URI'],  1);

        $route = array_filter($this->routes, function($route) use ($method, $uri){
            return $route->requestMethod == $method && \Utils\match_($uri, $route->path);
        });

        if(Empty($route) == true) {
            echo "404 route";
            die();
        }
        return reset($route);
    }

    private function getControllerInstace(string $className){
        $controller = array_filter($this->controllers, function($controller) use ($className){
            return get_class($controller) == $className;
        });

        if(Empty($controller)) {
            echo "404 controller";
            die();
        }

        return reset($controller);
    }
}