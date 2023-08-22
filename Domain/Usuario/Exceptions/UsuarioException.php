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

    public static function emailExistente(string $email): self {
        throw new self('O email ' . $email . ' já existe, por favor, entre no sistema.');
    }

    public static function codigoDifereDoEmail(): self {
        throw new self('O código que você informou não é o mesmo que você recebeu no email, por favor, verifique.');
    }
}