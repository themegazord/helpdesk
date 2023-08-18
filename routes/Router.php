<?php

namespace routes;

use app\providers\Container;

require_once 'vendor\autoload.php';

class Router {
    private array $routes = [];

    public function addRoute($url, $controller, $method): void {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method];
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function route($url): void {
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