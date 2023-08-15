<?php

namespace routes;

class Router {
    private $routes = [];

    public function addRoute($url, $controller, $method, array $di) {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method, 'di' => $di];
    }

    /**
     * @throws \ReflectionException
     */
    public function route($url) {
        if (isset($this->routes[$url])) {
            $route = $this->routes[$url];
            $controllerName = $route['controller'];
            $methodName = $route['method'];
            $di = $route['di'];

//            require_once $controllerName;
            $controllerPuro = new \ReflectionClass($controllerName);
            $controller = $controllerPuro->newInstanceArgs($di);
            $controller->$methodName();
        } else {
            var_dump("404 - Page not found");
        }
    }
}