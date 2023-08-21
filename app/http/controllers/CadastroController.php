<?php

namespace app\http\controllers;


use app\FormRequest\Autenticacao\CadastroRequest;
use Domain\Usuario\Services\UsuarioService;
use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;

require 'routes\routeHelpers.php';

require_once 'vendor/autoload.php';
class CadastroController
{
    public function __construct(
        private readonly CadastroRequest $cadastroRequest,
        private readonly UsuarioService $usuarioService
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
                $emailUsuarioNovo = $this->cadastroRequest->dispatch($novoUsuario);
                $hashEmail = base64_encode($emailUsuarioNovo);
                if (!empty($emailUsuarioNovo)) {
                    redirect('/cadastro/validaemail?usuario=' . $hashEmail);
                }
            } catch (UsuarioException $ue) {
                $errosCadastroForm = [
                    'erros' => [$ue->getMessage()]
                ];
                include 'resources\views\Cadastro\CadastroView.php';
            }
        }
    }

    public function validaEmail(string $emailHash): void {
        $usuario = $this->usuarioService->consultaEmailExistente(base64_decode($emailHash));
        if (empty($usuario)) {
            redirect('/');
        };
        include 'resources\views\ValidaEmail\ValidaEmail.php';
    }
}