<?php

namespace Domain\Usuario\Services;

use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;
use Domain\Usuario\Interfaces\IUsuario;

class UsuarioService
{
    public function __construct(private readonly IUsuario $usuarioRepository)
    {
    }

    public function cadastro(UsuarioDTO $usuarioDTO): UsuarioException|string {
        if (!empty($this->consultaEmailExistente($usuarioDTO->getEmailUsuario()))) return UsuarioException::emailExistente($usuarioDTO->getEmailUsuario());
        $usuarioDTO->setSenhaUsuario($this->criptografaSenha($usuarioDTO->getSenhaUsuario()));
        return $this->usuarioRepository->cadastro($usuarioDTO);
    }

    public function consultaEmailExistente(string $email): string|array {
        return $this->usuarioRepository->queryUsuarioPorEmail($email);
    }

    private function criptografaSenha(string $senha): string {
        return password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}