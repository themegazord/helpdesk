<?php

namespace infrastructure\Persistence\Repositories\Log;

use Domain\Log\DTO\LogDTO;
use Domain\Log\Interfaces\ILog;
use Infrastructure\Database\DatabaseConnection;

require_once 'vendor/autoload.php';

class LogRepository implements ILog
{
    private $db;
    public function __construct(private readonly DatabaseConnection $connection)
    {
        $this->db = $this->connection->getPdo();
    }

    public function cadastro(LogDTO $log)
    {
        try {
            $data_log = \DateTime::createFromFormat('d/m/Y', $log->getDataLog())->format('Y-m-d');
            $nivel = $log->getNivel();
            $mensagem = $log->getMensagem();

            $stmt = $this->db->prepare(
                "INSERT INTO log(data_log, nivel, mensagem) 
                    VALUES (:data_log, :nivel, :mensagem)"
            );

            $stmt->bindParam(":data_log", $data_log, \PDO::PARAM_STR);
            $stmt->bindParam(':nivel', $nivel, \PDO::PARAM_STR);
            $stmt->bindParam(':mensagem', $mensagem, \PDO::PARAM_STR);

            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Erro na inserção do log" . $e->getMessage();
        }
    }
}