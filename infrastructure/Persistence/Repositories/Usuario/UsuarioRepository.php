<?php

namespace Infrastructure\Persistence\Repositories\Usuario;

use Infrastructure\Database\DatabaseConnection;
use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Interfaces\IUsuario;

require 'Domain\Usuario\Interfaces\IUsuario.php';

class UsuarioRepository implements IUsuario
{
    private $db;
    public function __construct(private readonly DatabaseConnection $connection)
    {
        $this->db = $this->connection->getPdo();
    }

    public function cadastro(UsuarioDTO $usuarioDTO)
    {

    }
}