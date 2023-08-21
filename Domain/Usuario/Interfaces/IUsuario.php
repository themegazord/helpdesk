<?php

namespace Domain\Usuario\Interfaces;

use Domain\Usuario\DTO\UsuarioDTO;

interface IUsuario
{
    public function cadastro(UsuarioDTO $usuarioDTO): string;
    public function queryUsuarioPorEmail(string $email);
}