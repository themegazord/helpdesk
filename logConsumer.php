<?php

namespace servidoresInternos;

use Domain\Log\DTO\LogDTO;
use Domain\Log\Services\LogService;
use infrastructure\Persistence\Repositories\Log\LogRepository;
use Infrastructure\Database\DatabaseConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

require 'infrastructure\Database\DatabaseConnection.php';

require_once __DIR__ . '/vendor/autoload.php';

$db = new DatabaseConnection();
$log = new LogService(new LogRepository($db));

$logCadastroUsuario = '';

$conexao = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$canal = $conexao->channel();

$canal->queue_declare('cadastroUsuario', false, true, false, false);

$callback = function ($msg) use (&$log){
    $log->cadastro($msg->body);
    echo "Mensagem recebida \n" . $msg->body;
    $msg->ack();
    echo "\nResposta enviada...\n";
};

$canal->basic_qos(null, 1, null);
$canal->basic_consume('cadastroUsuario', '', false, false, false, false, $callback);

echo "Esperando mensagens novas... \n";

while($canal->is_open()) {
    $canal->wait();
}

$conexao->close();
$canal->close();

