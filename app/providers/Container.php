<?php

namespace app\providers;

use app\http\controllers\LoginController;
use app\http\controllers\CadastroController;
use app\http\controllers\HomeController;
use app\FormRequest\Autenticacao\CadastroRequest;
use app\FormRequest\Autenticacao\LoginRequest;
use Infrastructure\Database\DatabaseConnection;
use Domain\Usuario\Services\UsuarioService;
use Domain\Log\Services\LogService;
use Infrastructure\Persistence\Repositories\Usuario\UsuarioRepository;
use infrastructure\Persistence\Repositories\Log\LogRepository;

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
            // Interfaces
            if ($nomeClasse == 'IUsuario') {
                $databaseConnection = $this->resolve('DB');
                return new $classeConcreta($databaseConnection);
            }
            if ($nomeClasse == 'ILog') {
                $databaseConnection = $this->resolve('DB');
                return new $classeConcreta($databaseConnection);
            }
            // Services
            if ($nomeClasse == 'UsuarioService') {
                $usuarioRepository = $this->resolve('IUsuario');
                return new $classeConcreta($usuarioRepository);
            }
            if ($nomeClasse == 'LogService') {
                $logRepository = $this->resolve('ILog');
                return new $classeConcreta($logRepository);
            }
            // Form Request
            if ($nomeClasse == 'CadastroRequest') {
                $usuarioService = $this->resolve('UsuarioService');
                return new $classeConcreta($usuarioService);
            }
            if ($nomeClasse == 'LoginRequest') {
                $usuarioService = $this->resolve('UsuarioService');
                return new $classeConcreta($usuarioService);
            }
            // Controllers
            if ($nomeClasse == 'CadastroController') {
                $cadastroRequest = $this->resolve('CadastroRequest');
                $usuarioService = $this->resolve('UsuarioService');
                $logService = $this->resolve('LogService');
                $envioEmailService = $this->resolve('EnvioEmailService');
                return new $classeConcreta($cadastroRequest, $usuarioService, $logService, $envioEmailService);
            }
            if ($nomeClasse == 'LoginController') {
                $loginRequest = $this->resolve('LoginRequest');
                return new $classeConcreta($loginRequest);
            }
            return new $classeConcreta();
        }
        return null;
    }

    /**
     * @throws \Exception
     */
    public function register(string $classe): object {
        // Banco de Dados
        $this->bind('DB', 'infrastructure\Database\DatabaseConnection');
        // Interfaces - Repositories
        $this->bind('IUsuario', 'infrastructure\Persistence\Repositories\Usuario\UsuarioRepository');
        $this->bind('ILog', 'infrastructure\Persistence\Repositories\Log\LogRepository');
        // Services
        $this->bind('UsuarioService', 'Domain\Usuario\Services\UsuarioService');
        $this->bind('LogService', 'Domain\Log\Services\LogService');
        $this->bind('EnvioEmailService', 'Domain\EnvioEmail\Services\EnvioEmailService');
        // Form Requests
        $this->bind('CadastroRequest', 'app\FormRequest\Autenticacao\CadastroRequest');
        $this->bind('LoginRequest', 'app\FormRequest\Autenticacao\LoginRequest');
        // Controllers
        $this->bind('HomeController', 'app\http\controllers\HomeController');
        $this->bind('CadastroController', 'app\http\controllers\CadastroController');
        $this->bind('LoginController', 'app\http\controllers\LoginController');
        $this->bind('DashboardController', 'app\http\controllers\DashboardController');


        return match ($classe) {
            // Banco de dados
            'DB' => $this->resolve('DB'),
            // Interface
            'IUsuario' => $this->resolve('IUsuario'),
            'ILog' => $this->resolve('ILog'),
            // Services
            'UsuarioService' => $this->resolve('UsuarioService'),
            'LogService' => $this->resolve('LogService'),
            'EnvioEmailService' => $this->resolve('EnvioEmailService'),
            // Form Request
            'CadastroRequest' => $this->resolve('CadastroRequest'),
            'LoginRequest' => $this->resolve('LoginRequest'),
            // Controllers
            'HomeController' => $this->resolve('HomeController'),
            'CadastroController' => $this->resolve('CadastroController'),
            'LoginController' => $this->resolve('LoginController'),
            'DashboardController' => $this->resolve('DashboardController'),
            default => throw new \Exception("A classe inserida não está cadastrada no container")
        };
    }
}


