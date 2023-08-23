<?php

namespace app\FormRequest\Autenticacao;

use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;
use Domain\Usuario\Services\UsuarioService;

require_once 'vendor\autoload.php';
class LoginRequest
{
    public function __construct(private readonly UsuarioService $usuarioService) {
    }

    /**
     * @throws UsuarioException
     */
    public function dispatch(UsuarioDTO $usuarioDTO): array {
        $usuarioDTO->setEmailUsuario($this->validaEmail($usuarioDTO->getEmailUsuario()));
        $usuarioDTO->setSenhaUsuario($this->validaSenha($usuarioDTO->getSenhaUsuario()));
        return $this->usuarioService->login($usuarioDTO);
    }

    /**
     * @throws UsuarioException
     */
    private function validaEmail(string $email): string|UsuarioException {
        if (empty(trim($email))) return UsuarioException::emailEObrigatorio();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return UsuarioException::emailInvalido($email);
        return $email;
    }

    private function validaSenha(string $senha): string|UsuarioException {
        if (empty(trim($senha))) return UsuarioException::senhaEObrigatorio();
        return $senha;
    }
}