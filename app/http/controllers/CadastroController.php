<?php

namespace app\http\controllers;

use app\FormRequest\Autenticacao\CadastroRequest;
use Domain\EnvioEmail\Services\EnvioEmailService;
use Domain\Log\Services\LogService;
use Domain\Usuario\Services\UsuarioService;
use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;

require 'routes\routeHelpers.php';

require_once 'vendor/autoload.php';
class CadastroController
{
    public function __construct(
        private readonly CadastroRequest $cadastroRequest,
        private readonly UsuarioService $usuarioService,
        private readonly LogService $logService,
        private readonly EnvioEmailService $emailService
    )
    {
        session_start();
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
                $usuario = $this->cadastroRequest->dispatch($novoUsuario);
                $this->logService->logCadastroUsuario('nivel=INFO;mensagem=INSERT: O usuário portador do email -> ' . $usuario['email'] . ' cadastrado com sucesso', 'cadastroUsuario');
                $hashEmail = base64_encode($usuario['email']);
                $this->emailService->envioEmail("email=" . $usuario['email'] . ";codigo=" . $usuario['codigo_verificacao'], 'emailCodigoVerificacao');
                if (!empty($usuario['email'])) {
                    redirect("/cadastro/validaemail?usuario={$hashEmail}");
                }
            } catch (UsuarioException $ue) {
                redirect('/cadastro?erro=' . urlencode($ue->getMessage()));
            } catch (\Exception $e) {
                redirect("/cadastro?erro=".urlencode($e->getMessage()));
            }
        }
    }

    public function validaEmail(string $emailHash, string $notify = null): void {
        $usuario = $this->usuarioService->consultaEmailExistente(
            str_contains($emailHash, 'usuario=')
            ? base64_decode(explode('=', ($emailHash))[1])
            : base64_decode($emailHash)
        );
        if (empty($usuario)) {
            redirect('/');
        };
        include 'resources\views\ValidaEmail\ValidaEmail.php';
    }

    public function procassaDadosValidaEmail(): void{
        $codigo = $_POST['cod'];
        $hash = $_POST['hash'];
        try {
            $this->usuarioService->validaCodigoVerificacao($hash, $codigo);
            redirect('/');
        } catch (UsuarioException $e) {
            redirect("/cadastro/validaemail?usuario={$hash}&erro={$e->getMessage()}");
        }
    }
}