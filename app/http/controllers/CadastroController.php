<?php

namespace app\http\controllers;


use app\FormRequest\Autenticacao\CadastroRequest;
use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;

require 'routes\routeHelpers.php';

require_once 'vendor/autoload.php';
class CadastroController
{
    public function __construct(
        private readonly CadastroRequest $cadastroRequest
    )
    {
    }

    public function index(): void {
        include 'resources\views\Cadastro\CadastroView.php';
    }

    public function processaDadosCadastro(): void {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $novoUsuario = new UsuarioDTO();
            $novoUsuario->setNomeUsuario($_POST['nome-cadastro']);
            $novoUsuario->setEmailUsuario($_POST['email-cadastro']);
            $novoUsuario->setSenhaUsuario($_POST['senha-cadastro']);

            try {
                if ($this->cadastroRequest->dispatch($novoUsuario)) {
                    redirect('/cadastro/validaemail');
                }
            } catch (UsuarioException $ue) {
                $errosCadastroForm = [
                    'erros' => [$ue->getMessage()]
                ];
                include 'resources\views\Cadastro\CadastroView.php';
            }
        }
    }

    public function validaEmail(): void {
        include 'resources\views\ValidaEmail\ValidaEmail.php';
    }
}