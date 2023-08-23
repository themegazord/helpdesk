<?php

namespace app\http\controllers;

class HomeController {
    public function __construct(){
        session_start();
    }
    public function index(): void {
        include 'resources/views/Home/HomeView.php';
    }
}