<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Domain\EnvioEmail\Services\EnvioEmailService;



//
//$conexao = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
//$canal = $conexao->channel();
//
//$canal->queue_declare('emailCodigoVerificacao', false, true, false, false);
//
//$callback = function ($msg) use (&$envioEmail) {
//    $envioEmail->enviaCodigoVerificacao($msg->body);
//    echo "Mensagem recebida...\n";
//    $msg->ack();
//    echo "\nResposta enviada...\n";
//};
//
//$canal->basic_qos(null, 1, null);
//$canal->basic_consume('emailCodigoVerificacao', '', false, false, false, false, $callback);
//
//echo "Esperando mensagens novas... \n";
//
//while($canal->is_open()) {
//    $canal->wait();
//}
//
//$canal->close();
//$conexao->close();

$envioEmail = new EnvioEmailService();

$conexao = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$canal = $conexao->channel();

$canal->exchange_declare('emails', 'direct', false, false, false);

list($nome_fila, ,) = $canal->queue_declare("", false, false, true, false);

$usosEmail = ['emailCodigoVerificacao'];

if (empty($usosEmail)) {
    file_put_contents('php://stdder', "Nenhum uso configurado");
}

foreach ($usosEmail as $uso) {
    $canal->queue_bind($nome_fila, 'emails', $uso);
}

echo " [*] Esperando pelos emails. Para sair aperte CTRL+C\n";

$callback = function ($mensagem) use (&$envioEmail) {
    $uso = $mensagem->delivery_info['routing_key'];
    match ($uso) {
        'emailCodigoVerificacao' => $envioEmail->enviaCodigoVerificacao($mensagem->body),
        default => "Uso indevido {$uso}",
    };
    echo " [x] {$mensagem->delivery_info['routing_key']} : {$mensagem->body} \n";
};

$canal->basic_consume($nome_fila, '', false, true, false, false, $callback);

while ($canal->is_open()) {
    $canal->wait();
}

$canal->close();
$conexao->close();