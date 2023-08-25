<?php


namespace app\http\controllers;


use app\FormRequest\Autenticacao\LoginRequest;
use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;

require 'routes\routeHelpers.php';

require_once 'vendor\autoload.php';

class LoginController
{
    public function __construct(
        public readonly LoginRequest $loginRequest
    )
    {
        session_start();
    }

    public function index(): void {
        include('resources\views\Login\LoginView.php');
    }

    public function processaDadosLogin(): void {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new UsuarioDTO();
            $usuario->setEmailUsuario($_POST['email-login']);
            $usuario->setSenhaUsuario($_POST['senha-login']);
            try {
                $respostaLogin = $this->loginRequest->dispatch($usuario);
                $_SESSION['email'] = $respostaLogin['email'];
                $_SESSION['nome'] = $respostaLogin['nome'];
                redirect('/dashboard');
            } catch (UsuarioException $ue) {
                redirect('/login?erro=' . urlencode($ue->getMessage()));
            }
        }
    }
}