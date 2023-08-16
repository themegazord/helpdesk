<?php

namespace Infrastructure\Database;

class DatabaseConnection
{
    private \PDO $pdo;
    public function __construct()
    {
        $dsn="mysql:host=127.0.0.1;dbname=helpdesk;charset=utf8mb4";
        $usuario = 'root';
        $senha ='Superonze02!';

        try {
            $this->pdo = new \PDO($dsn, $usuario, $senha);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $pdoe) {
            die("Erro de conexão: " . $pdoe->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}