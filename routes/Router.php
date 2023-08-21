<?php

namespace routes;

use app\providers\Container;
use app\http\controllers\CadastroController;
use app\http\controllers\HomeController;

require_once 'vendor\autoload.php';


class Router {
    private array $routes = [];

    public function addRoute($url, $controller, $method): void {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method];
    }

    public function route($url): void {
        $container = new Container();
        $param = null;
        if (str_contains($url, '?')) {
            $param = explode('=', explode('?', $url)[1])[1];
            $url = explode('?', $url)[0];
        }
        if (isset($this->routes[$url])) {
            $route = $this->routes[$url];
            $controllerName = $container->register($route['controller']);
            $methodName = $route['method'];

            $controller = $controllerName;
            $controller->$methodName($param);
        } else {
            var_dump("404 - Page not found");
        }
    }
}