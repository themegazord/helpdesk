<?php

namespace Domain\Log\Services;

use Domain\Log\DTO\LogDTO;
use Domain\Log\Interfaces\ILog;
use PhpAmqpLib\Connection\AMQPStreamConnection;

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
}