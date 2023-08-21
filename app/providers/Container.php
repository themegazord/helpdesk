<?php

namespace app\providers;

use app\http\controllers\CadastroController;
use app\http\controllers\HomeController;
use app\FormRequest\Autenticacao\CadastroRequest;
use Infrastructure\Database\DatabaseConnection;
use Domain\Usuario\Services\UsuarioService;
use Infrastructure\Persistence\Repositories\Usuario\UsuarioRepository;

require_once 'vendor/autoload.php';

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
                $usuarioService = $this->resolve('UsuarioService');
                return new $classeConcreta($cadastroRequest, $usuarioService);
            }
            return new $classeConcreta();
        }
        return null;
    }

    /**
     * @throws \Exception
     */
    public function register(string $classe): object {
        $this->bind('DB', 'infrastructure\Database\DatabaseConnection');
        $this->bind('IUsuario', 'infrastructure\Persistence\Repositories\Usuario\UsuarioRepository');
        $this->bind('UsuarioService', 'Domain\Usuario\Services\UsuarioService');
        $this->bind('CadastroRequest', 'app\FormRequest\Autenticacao\CadastroRequest');
        $this->bind('CadastroController', 'app\http\controllers\CadastroController');
        $this->bind('HomeController', 'app\http\controllers\HomeController');


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


