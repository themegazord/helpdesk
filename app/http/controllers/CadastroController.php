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
                $this->logCadastroUsuario($emailUsuarioNovo);
                $hashEmail = base64_encode($emailUsuarioNovo);
                if (!empty($emailUsuarioNovo)) {
                    redirect('/cadastro/validaemail?usuario=' . $hashEmail);
                }
            } catch (UsuarioException $ue) {
                $errosCadastroForm = [
                    'erros' => [$ue->getMessage()]
                ];
                include 'resources\views\Cadastro\CadastroView.php';
            } catch (\Exception $e) {
                $errosCadastroForm = [
                    'erros' => [$e->getMessage()]
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

    /**
     * @throws \Exception
     */
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
}