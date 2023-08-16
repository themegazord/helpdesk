<?php

namespace providers;

use app\http\controllers\CadastroController;
use app\http\controllers\HomeController;
use app\FormRequest\Autenticacao\CadastroRequest;
use Infrastructure\Database\DatabaseConnection;
use Domain\Usuario\Services\UsuarioService;
use Infrastructure\Persistence\Repositories\Usuario\UsuarioRepository;

require 'app\http\controllers\HomeController.php';
require 'app\http\controllers\CadastroController.php';
require 'app\FormRequest\Autenticacao\CadastroRequest.php';
require 'Domain\Usuario\Services\UsuarioService.php';
require 'Infrastructure\Persistence\Repositories\Usuario\UsuarioRepository.php';
require 'Infrastructure\Database\DatabaseConnection.php';

class Container
{
    private $bindings = [];
    public function bind(string $classeAbstrata, string $classeConcreta): void {
        $this->bindings[$classeAbstrata] = $classeConcreta;
    }

    public function resolve($nomeClasse): ?object {
        if (isset($this->bindings[$nomeClasse])) {
            $classeConcreta = $this->bindings[$nomeClasse];

            if ($nomeClasse == 'IUsuario') {
                $databaseConnection = $this->resolve('DB');
                return new $classeConcreta($databaseConnection);
            }
            if ($nomeClasse == 'UsuarioService') {
                $usuarioRepository = $this->resolve('IUsuario');
                return new $classeConcreta($usuarioRepository);
            }
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
        $this->bind('DB', '\Infrastructure\Database\DatabaseConnection');
        $this->bind('IUsuario', '\Infrastructure\Persistence\Repositories\Usuario\UsuarioRepository');
        $this->bind('UsuarioService', '\Domain\Usuario\Services\UsuarioService');
        $this->bind('CadastroRequest', '\app\FormRequest\Autenticacao\CadastroRequest');
        $this->bind('CadastroController', '\app\http\controllers\CadastroController');
        $this->bind('HomeController', '\app\http\controllers\HomeController');


        return match ($classe) {
            'DB' => $this->resolve('DB'),
            'IUsuario' => $this->resolve('IUsuario'),
            'HomeController' => $this->resolve('HomeController'),
            'CadastroController' => $this->resolve('CadastroController'),
            'CadastroRequest' => $this->resolve('CadastroRequest'),
            'UsuarioService' => $this->resolve('UsuarioService'),
            default => throw new \Exception("A classe inserida não está cadastrada no container")
        };
    }
}


