<?php

namespace providers;

use app\http\controllers\CadastroController;
use app\http\controllers\HomeController;
use app\services\Autenticacao\CadastroService as appCadastroService;

require 'app\http\controllers\HomeController.php';
require 'app\http\controllers\CadastroController.php';
require 'app\services\Autenticacao\CadastroService.php';

class Container
{
    private $bindings = [];
    public function bind(string $nomeClasse, object $classeAbstrata, object $classeConcreta): void {
        $this->bindings[$nomeClasse]['classeAbstrata'] = $classeAbstrata;
        $this->bindings[$nomeClasse]['classeConcreta'] = $classeConcreta;
    }

    public function resolve($nomeClasse): ?object {
        if (isset($this->bindings[$nomeClasse])) {
            $classeConcreta = $this->bindings[$nomeClasse]['classeConcreta'];
            return new $classeConcreta();
        }
        return null;
    }

    /**
     * @throws \Exception
     */
    public function register(string $classe): object {
        $this->bind('app.CadastroService', new appCadastroService(), new appCadastroService());

        $appCadastroService = $this->resolve('app.CadastroService');

        return match ($classe) {
            'HomeController' => new HomeController(),
            'CadastroController' => new CadastroController($appCadastroService),
            default => throw new \Exception("A classe inserida não está cadastrada no container", 400)
        };
    }
}


