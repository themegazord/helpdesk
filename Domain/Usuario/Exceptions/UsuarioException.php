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

    /**
     * @throws UsuarioException
     */
    public static function emailInvalido(string $email): self {
        throw new self(message: 'O email ' . $email . ' é inválido');
    }
}