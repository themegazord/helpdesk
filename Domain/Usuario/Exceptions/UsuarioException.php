<?php

namespace Domain\Usuario\Exceptions;

class UsuarioException extends \Exception
{
    /**
     * @throws UsuarioException
     */
    public static function emailEObrigatorio(): self {
        throw new self('O email não pode ser vazio');
    }

    public static function senhaEObrigatorio(): self {
        throw new self('A senha não pode ser vazio');
    }

    /**
     * @throws UsuarioException
     */
    public static function emailInvalido(string $email): self {
        throw new self(message: 'O email ' . $email . ' é inválido');
    }

    /**
     * @throws UsuarioException
     */
    public static function senhaInvalida(): self {
        throw new self('Senha inválida');
    }

    /**
     * @throws UsuarioException
     */
    public static function emailExistente(string $email): self {
        throw new self('O email ' . $email . ' já existe, por favor, entre no sistema.');
    }

    /**
     * @throws UsuarioException
     */
    public static function emailInexistente(string $email): self {
        throw new self('O email ' . $email . ' não existe, por favor, cadastre-se.');
    }

    /**
     * @throws UsuarioException
     */
    public static function codigoDifereDoEmail(): self {
        throw new self('O código que você informou não é o mesmo que você recebeu no email, por favor, verifique.');
    }
}