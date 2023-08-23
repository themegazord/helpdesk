<?php

namespace app\http\controllers;

class LoginController
{
    public function index(): void {
        include('resources\views\Login\LoginView.php');
    }
}