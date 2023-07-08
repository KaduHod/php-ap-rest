<?php 

namespace Routes;

class Route {
    public string $controller;
    public string $method;
    public string $requestMethod;
    public string $path;

    function __construct(
        string $controller,
        string $method,
        string $requestMethod,
        string $path
    ){
        $this->controller = $controller;
        $this->method = $method;
        $this->requestMethod = $requestMethod;
        $this->path = $path;
    }
}