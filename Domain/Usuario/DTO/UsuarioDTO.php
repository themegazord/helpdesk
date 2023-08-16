<?php

namespace Domain\Usuario\DTO;

class UsuarioDTO
{
    private string $nomeUsuario;
    private string $emailUsuario;
    private string $senhaUsuario;

    /**
     * @return string
     */
    public function getEmailUsuario(): string
    {
        return $this->emailUsuario;
    }

    /**
     * @return string
     */
    public function getNomeUsuario(): string
    {
        return $this->nomeUsuario;
    }

    /**
     * @return string
     */
    public function getSenhaUsuario(): string
    {
        return $this->senhaUsuario;
    }

    /**
     * @param string $emailUsuario
     */
    public function setEmailUsuario(string $emailUsuario): void
    {
        $this->emailUsuario = $emailUsuario;
    }

    /**
     * @param string $nomeUsuario
     */
    public function setNomeUsuario(string $nomeUsuario): void
    {
        $this->nomeUsuario = $nomeUsuario;
    }

    /**
     * @param string $senhaUsuario
     */
    public function setSenhaUsuario(string $senhaUsuario): void
    {
        $this->senhaUsuario = $senhaUsuario;
    }
}