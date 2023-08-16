<?php

namespace providers;

use app\http\controllers\CadastroController;
use app\http\controllers\HomeController;
use app\FormRequest\Autenticacao\CadastroRequest;
use Domain\Usuario\Services\UsuarioService;

require 'app\http\controllers\HomeController.php';
require 'app\http\controllers\CadastroController.php';
require 'app\FormRequest\Autenticacao\CadastroRequest.php';
require 'Domain\Usuario\Services\UsuarioService.php';

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
            if ($nomeClasse == 'CadastroRequest') {
                $usuarioService = $this->resolve('UsuarioService');
                return new $classeConcreta($usuarioService);
            }
            if ($nomeClasse == 'CadastroController') {
                $cadastroRequest = $this->resolve('CadastroRequest');
                return new $classeConcreta($cadastroRequest);
            }
            return new $classeConcreta();
        }
        return null;
    }

    /**
     * @throws \Exception
     */
    public function register(string $classe): object {
        $this->bind('UsuarioService', new UsuarioService(), new UsuarioService());
        $usuarioService = $this->resolve('UsuarioService');

        $this->bind('CadastroRequest', new CadastroRequest($usuarioService), new CadastroRequest($usuarioService));
        $cadastroRequest = $this->resolve('CadastroRequest');

        $this->bind('CadastroController', new CadastroController($cadastroRequest), new CadastroController($cadastroRequest));


        return match ($classe) {
            'HomeController' => new HomeController(),
            'CadastroController' => new CadastroController($cadastroRequest),
            'CadastroRequest' => new CadastroRequest($usuarioService),
            'UsuarioService' => $usuarioService,
            default => throw new \Exception("A classe inserida não está cadastrada no container")
        };
    }
}


