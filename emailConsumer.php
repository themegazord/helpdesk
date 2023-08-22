<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;

require_once __DIR__ . '/vendor/autoload.php';

$conexao = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$canal = $conexao->channel();

$canal->queue_declare('emailCodigoVerificacao', false, true, false, false);

$callback = function ($msg) {
    echo "Mensagem recebida...\n";
    echo $msg->body;
    echo "\nResposta enviada...\n";
    $msg->ack();
};

$canal->basic_qos(null, 1, null);
$canal->basic_consume('emailCodigoVerificacao', '', false, false, false, false, $callback);

echo "Esperando mensagens novas... \n";

while($canal->is_open()) {
    $canal->wait();
}

$canal->close();
$conexao->close();
