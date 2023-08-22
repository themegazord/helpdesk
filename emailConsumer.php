<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Domain\EnvioEmail\Services\EnvioEmailService;

require_once __DIR__ . '/vendor/autoload.php';

$envioEmail = new EnvioEmailService();

$conexao = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$canal = $conexao->channel();

$canal->queue_declare('emailCodigoVerificacao', false, true, false, false);

$callback = function ($msg) use (&$envioEmail) {
    $envioEmail->enviaCodigoVerificacao($msg->body);
    echo "Mensagem recebida...\n";
    $msg->ack();
    echo "\nResposta enviada...\n";
};

$canal->basic_qos(null, 1, null);
$canal->basic_consume('emailCodigoVerificacao', '', false, false, false, false, $callback);

echo "Esperando mensagens novas... \n";

while($canal->is_open()) {
    $canal->wait();
}

$canal->close();
$conexao->close();
