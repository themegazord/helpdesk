<?php

namespace app\http\controllers;

class DashboardController
{
    public function __construct()
    {
        session_start();
    }

    public function index(): void {
        $data = [
            'tickets' => [2,5,6,1,5],
            'nps' => 7.6,
            'prioridade' => [
                'baixa' => 2,
                'normal' => 7,
                'alta' => 3,
                'urgente' => 1
            ]
        ];
        include 'resources/views/Dashboard/DashboardView.php';
    }
}