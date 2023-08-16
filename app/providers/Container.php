<?php

namespace providers;

use app\http\controllers\HomeController;
use app\infrastructe\mock\HomeNavLinks\NavLinks;

require 'infrastructure\mock\HomeNavLinks\NavLinks.php';
require 'app\http\controllers\HomeController.php';

class Container
{
    private $bindings = [];
    public function bind(string $nomeClasse, object $classeConcreta) {
        $this->bindings[$nomeClasse] = $classeConcreta;
    }

    public function resolve($nomeClasse): ?object {
        if (isset($this->bindings[$nomeClasse])) {
            $classeConcreta = $this->bindings[$nomeClasse];
            return new $classeConcreta();
        }
        return null;
    }

    /**
     * @throws \Exception
     */
    public function register(string $classe): object {
        $this->bind('NavLinks', new NavLinks());

        $navLinks = $this->resolve('NavLinks');

        return match ($classe) {
            'HomeController' => new HomeController($navLinks),
            default => throw new \Exception("A classe inserida não está cadastrada no container", 400)
        };
    }
}


