<?php

namespace app\http\controllers;

class DashboardController
{
    public function __construct()
    {
        session_start();
    }

    public function index(): void {
        include 'resources/views/Dashboard/DashboardView.php';
    }
}