<?php

namespace routes;

use providers\Container;

require 'app\providers\Container.php';

class Router {
    private $routes = [];

    public function addRoute($url, $controller, $method) {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method];
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function route($url) {
        $container = new Container();
        if (isset($this->routes[$url])) {
            $route = $this->routes[$url];
            $controllerName = $container->register($route['controller']);
            $methodName = $route['method'];

            $controller = $controllerName;
            $controller->$methodName();
        } else {
            var_dump("404 - Page not found");
        }
    }
}