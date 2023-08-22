<?php

namespace Domain\EnvioEmail\Services;

use Domain\EnvioEmail\DTO\EnvioEmailDTO;

require 'vendor\autoload.php';

class EnvioEmailService
{
    public function enviaCodigoVerificacao(string $resposta): void {
        $email = explode('=', explode(';', $resposta)[0])[1];
        $codigo = explode('=', explode(';', $resposta[1])[1]);

        $envioEmail = new EnvioEmailDTO();
        $envioEmail->setDestinatario($email);
        $envioEmail->setCabecalho([
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=iso-8859-1'
        ]);
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

        mail($envioEmail->getDestinatario(), $envioEmail->getTitulo(), $envioEmail->getCorpo(), $envioEmail->getCabecalho());
    }
}