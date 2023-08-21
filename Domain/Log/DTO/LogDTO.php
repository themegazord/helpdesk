<?php

namespace Domain\Log\DTO;

class LogDTO
{
    private string $data_log;
    private string $nivel;
    // INFO, AVISO, ERRO

    private string $mensagem;

    public function getDataLog(): string {
        return $this->data_log;
    }

    public function getNivel(): string {
        return $this->nivel;
    }

    public function getMensagem(): string {
        return $this->mensagem;
    }

    /**
     * @param string $data_log
     */
    public function setDataLog(string $data_log): void
    {
        $this->data_log = $data_log;
    }

    public function setNivel(string $nivel): void
    {
        $this->nivel = $nivel;
    }

    public function setMensagem(string $mensagem): void
    {
        $this->mensagem = $mensagem;
    }
}