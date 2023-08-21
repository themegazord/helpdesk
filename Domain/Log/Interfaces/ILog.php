<?php

namespace Domain\Log\Interfaces;

use Domain\Log\DTO\LogDTO;

interface ILog
{

    public function cadastro(LogDTO $log);

}