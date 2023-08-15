<?php

class Router {
    private $routes = [];

    public function addRoute($url, $controller, $method) {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method];
    }

    public function route($url) {
        if (isset($this->routes[$url])) {
            $route = $this->routes[$url];
            $controllerName = $route['controller'];
            $methodName = $route['method'];

            require_once "app/http/controllers/$controllerName.php";

            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            var_dump("404 - Page not found");
        }
    }
}