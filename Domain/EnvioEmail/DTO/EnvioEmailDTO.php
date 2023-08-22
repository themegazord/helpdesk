<?php

namespace Domain\EnvioEmail\DTO;

class EnvioEmailDTO
{
    private string $destinatario;
    private string $corpo;
    private string $titulo;
    private array $cabecalho;

    public function getDestinatario(): string
    {
        return $this->destinatario;
    }

    public function getCorpo(): string
    {
        return $this->corpo;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getCabecalho(): string
    {
        return $this->cabecalho;
    }

    public function setDestinatario(string $destinatario): void
    {
        $this->destinatario = $destinatario;
    }

    public function setCorpo(string $corpo): void
    {
        $this->corpo = $corpo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setCabecalho(array $cabecalho): void
    {
        $this->cabecalho = $cabecalho;
    }
}