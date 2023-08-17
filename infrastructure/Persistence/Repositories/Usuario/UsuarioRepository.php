<?php

namespace Infrastructure\Persistence\Repositories\Usuario;

use Infrastructure\Database\DatabaseConnection;
use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Interfaces\IUsuario;

require_once 'vendor/autoload.php';
class UsuarioRepository implements IUsuario
{
    private $db;
    public function __construct(private readonly DatabaseConnection $connection)
    {
        $this->db = $this->connection->getPdo();
    }

    public function cadastro(UsuarioDTO $usuarioDTO): bool
    {
        try {
            $usuario_nome = $usuarioDTO->getNomeUsuario();
            $usuario_email = $usuarioDTO->getEmailUsuario();
            $usuario_senha = $usuarioDTO->getSenhaUsuario();

            $stmt = $this->db->prepare("INSERT INTO usuarios(usuario_nome, usuario_email, usuario_senha) VALUES (:usuario_nome, :usuario_email , :usuario_senha)");

            $stmt->bindParam(":usuario_nome", $usuario_nome, \PDO::PARAM_STR);
            $stmt->bindParam(":usuario_email", $usuario_email, \PDO::PARAM_STR);
            $stmt->bindParam(":usuario_senha", $usuario_senha, \PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            echo "Erro no cadastro do usuario: " . $e->getMessage();
        }
    }

    public function queryUsuarioPorEmail(string $email): string|array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario_email = :email");
            $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return "Erro na consulta de usuarios por email: " . $e->getMessage();
        }
    }
}