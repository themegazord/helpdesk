<?php

namespace Domain\Usuario\Services;

use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Interfaces\IUsuario;

class UsuarioService
{
    public function __construct(private readonly IUsuario $usuarioRepository)
    {
    }

    public function cadastro(UsuarioDTO $usuarioDTO) {
        var_dump($usuarioDTO);
    }
}