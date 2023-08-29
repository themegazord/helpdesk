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
            2,5,6,1,5
        ];
        include 'resources/views/Dashboard/DashboardView.php';
    }
}