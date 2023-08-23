<?php

namespace Domain\Log\Services;

use Domain\Log\DTO\LogDTO;
use Domain\Log\Interfaces\ILog;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once 'vendor\autoload.php';

class LogService
{
    public function __construct(
        private readonly ILog $logRepository)
    {
    }

    /**
     * @throws \Exception
     */
    public function cadastro(string $log): void
    {

        $response = explode(';', $log);

        $logDTO = new LogDTO();
        $logDTO->setDataLog(date('d/m/Y'));
        $logDTO->setNivel(explode('=', $response[0])[1]);
        $logDTO->setMensagem(explode('=', $response[1])[1]);

        $this->logRepository->cadastro($logDTO);
    }

    /**
     * @throws \Exception
     */
    public function logCadastroUsuario(string $data, string $queue): void {
        $conexaoMensageria = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $canal = $conexaoMensageria->channel();

        match($queue) {
            'cadastroUsuario' => $canal->queue_declare('cadastroUsuario', false, true, false, false)
        };

        $msg = new AMQPMessage(
            $data,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        match($queue) {
            'cadastroUsuario' => $canal->basic_publish($msg, '', 'cadastroUsuario')
        };

        $canal->close();
        $conexaoMensageria->close();
    }
}