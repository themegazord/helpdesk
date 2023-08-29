<?php

namespace Domain\EnvioEmail\Services;

use Domain\EnvioEmail\DTO\EnvioEmailDTO;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor\autoload.php';

class EnvioEmailService
{
    /**
     * @throws Exception
     */
    public function enviaCodigoVerificacao(string $resposta): void {

        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../../');
        $dotenv->load();

        $envioEmail = new EnvioEmailDTO();
        $phpMailler = new PHPMailer(true);

        $respostaArray = explode(';', $resposta);
        $email = explode('=', $respostaArray[0])[1];
        $codigo = explode('=', $respostaArray[1])[1];

        $header = "MIME-Version: 1.1\r\n";
        $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $header .= "From: lilith.sacrifate@gmail.com\r\n";

        $envioEmail->setCabecalho($header);
        $envioEmail->setTitulo('Seu código de verificação está pronto!');
        $envioEmail->setCorpo("
            <html>
                <head>
                    <title>Seu código de verificação está pronto!</title>
                </head>
                <body>
                    <p>Segue abaixo o código de verificação:</p>
                    <span>$codigo</span>
                </body>
            </html>
        ");
        $envioEmail->setDestinatario($email);

        try {
            $phpMailler->SMTPDebug = SMTP::DEBUG_SERVER;
            $phpMailler->isSMTP();
            $phpMailler->Host       = getenv('PHP_MAILLER_HOST');
            $phpMailler->SMTPAuth   = true;
            $phpMailler->Username   = getenv('PHP_MAILLER_USUARIO');
            $phpMailler->Password   = getenv('PHP_MAILLER_PASSWORD');
            $phpMailler->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $phpMailler->Port       = getenv('PHP_MAILLER_PORT');
            $phpMailler->CharSet    = 'utf-8';

            $phpMailler->setFrom(getenv('PHP_MAILLER_USUARIO'), 'Helpdesk');
            $phpMailler->addAddress($email);

            $phpMailler->isHTML(true);
            $phpMailler->Subject = $envioEmail->getTitulo();
            $phpMailler->Body    = $envioEmail->getCorpo();

            $phpMailler->send();
            echo "Email enviado com sucesso \n";
        }catch(\Exception $e) {
            echo "Mensagem não pode ser enviada. Mailler error: {$phpMailler->ErrorInfo} \n";
        }
    }

    /**
     * @throws \Exception
     */
    public function envioEmail(string $data, string $uso): void {

        $conexao = new AMQPStreamConnection('localhost', 5672,'guest', 'guest');
        $canal = $conexao->channel();

        $canal->exchange_declare('emails', 'direct', false, false, false);

        $mensagem = new AMQPMessage($data);

        match ($uso) {
          'emailCodigoVerificacao' => $canal->basic_publish($mensagem, 'emails', $uso),
        };

        echo "[X] Enviado {$uso} : {$data}\n";

        $canal->close();
        $conexao->close();
    }
}