<?php

namespace app\http\controllers;

use app\FormRequest\Autenticacao\CadastroRequest;
use Domain\Usuario\Services\UsuarioService;
use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require 'routes\routeHelpers.php';

require_once 'vendor/autoload.php';
class CadastroController
{
    public function __construct(
        private readonly CadastroRequest $cadastroRequest,
        private readonly UsuarioService $usuarioService
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
                $this->logCadastroUsuario($usuario['email']);
                $hashEmail = base64_encode($usuario['email']);
                $this->envioEmail($usuario['email'], $usuario['codigo_verificacao']);
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

    /**
     * @throws \Exception
     */

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
    private function logCadastroUsuario(string $email): void {
        $conexaoMensageria = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $canal = $conexaoMensageria->channel();

        $canal->queue_declare('cadastroUsuario', false, true, false, false);
        $data = 'nivel=INFO;mensagem=INSERT: O usuário portador do email -> ' . $email . ' cadastrado com sucesso';

        $msg = new AMQPMessage(
            $data,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $canal->basic_publish($msg, '', 'cadastroUsuario');

        $canal->close();
        $conexaoMensageria->close();
    }

    /**
     * @throws \Exception
     */
    private function envioEmail(string $email, int $codigo): void {
        $conexao = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $canal = $conexao->channel();

        $canal->queue_declare('emailCodigoVerificacao', false, true, false, false);
        $data = "email=" . $email . ";codigo=" . $codigo;

        $msg = new AMQPMessage(
            $data,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $canal->basic_publish($msg, '', 'emailCodigoVerificacao');

        $canal->close();
        $conexao->close();
    }
}