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
        $params = null;
        $notify = null;
        if (str_contains($url, '?')) {
            if(str_contains($url, '&')) {
                $params = explode('&', explode('?', $url)[1])[0];
                $notify = explode('&', explode('?', $url)[1])[1];
            } else {
                $params = explode('=', explode('?', $url)[1])[1];
            }
            $url = explode('?', $url)[0];
        }
        if (isset($this->routes[$url])) {
            $route = $this->routes[$url];
            $controllerName = $container->register($route['controller']);
            $methodName = $route['method'];

            $controller = $controllerName;
            $controller->$methodName($params, $notify);
        } else {
            var_dump("404 - Page not found");
        }
    }
}