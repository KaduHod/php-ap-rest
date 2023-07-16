<?php

namespace Routes;
use Routes\Route;

class Router {
    public array $routes;
   
    public function __construct()
    {
        $this->routes = [];
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
	$controller = $this->createControllerInstance($route->controller);
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

	public function createControllerInstance($controllerName){
		if(class_exists($controllerName)){
			return new $controllerName();
		} else {
			die("404 not found, controler doesnt exists!");	
		}
	}	
}
