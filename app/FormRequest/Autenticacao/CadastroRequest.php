<?php

namespace app\FormRequest\Autenticacao;

use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;
use Domain\Usuario\Services\UsuarioService;


require_once 'vendor/autoload.php';
class CadastroRequest
{
    public function __construct(private readonly UsuarioService $usuarioService)
    {
    }


    /**
     * @throws UsuarioException
     */
    public function dispatch(UsuarioDTO $usuario): void
    {
        $usuario->setEmailUsuario($this->validaEmail($usuario->getEmailUsuario()));
        if ($this->usuarioService->cadastro($usuario)) {
            include 'resources/views/Home/HomeView.php';
        }
    }

    /**
     * @throws UsuarioException
     */
    private function validaEmail(string $email): string|UsuarioException {
        if(empty(trim($email))) return UsuarioException::emailEObrigatorio();
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return UsuarioException::emailInvalido($email);
        return $email;
    }
}