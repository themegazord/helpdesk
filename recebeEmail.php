<?php

use Dotenv\Dotenv;

require 'vendor\autoload.php';

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();


$imapServer = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = getenv('PHP_MAILLER_USUARIO');
$password = getenv('PHP_MAILLER_PASSWORD');
$folder = "INBOX";



while (true) {
    sleep(5);
    $inbox = imap_open($imapServer, $username, $password);
    if ($inbox) {

        $emailIds = imap_search($inbox, 'UNSEEN', SE_UID);

        if ($emailIds) {
            foreach ($emailIds as $emailId) {
                $emailInfo = imap_headerinfo($inbox, $emailId);
                $titulo = $emailInfo->subject;
                $nomeRemetente = $emailInfo->from[0]->personal;
                $emailRemetente = $emailInfo->from[0]->mailbox . "@" . $emailInfo->from[0]->host;

                $cc = isset($emailInfo->cc) ?? $emailInfo->cc;
                $bcc = isset($emailInfo->bcc) ?? $emailInfo->bcc;
                $replyTo = isset($emailInfo->reply_to[0]->mailbox) ?? "{$emailInfo->reply_to[0]->mailbox}@{$emailInfo->reply_to[0]->host}";
                $references = isset($emailInfo->references) ?? $emailInfo->references;

                $emailContent = imap_fetchbody($inbox, $emailId, 1);
                $body = base64_decode($emailContent);

                echo "ID do E-mail: {$emailId}\n";
                echo "Titulo do e-mail: {$titulo}\n";
                echo "De: {$nomeRemetente} ({$emailRemetente}) \n";
                echo "CC: {$cc} \n";
                echo "BCC: {$bcc} \n";
                echo "Reply-To: " . $replyTo . "\n";
                echo "References: " . $references . "\n";
                echo "Conteúdo do E-mail: {$body}\n";
            }
        } else {
            echo "Nenhum e-mail encontrado na pasta '$folder'.\n";
        }
        // Fechar a conexão
    } else {
        echo "Não foi possível conectar ao servidor IMAP do Gmail.\n";
    }
    imap_close($inbox);
}
