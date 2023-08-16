<?php

namespace app\http\controllers;

class HomeController {
    public function __construct(){}
    public function index(): void {
        include 'resources/views/Home/HomeView.php';
    }
}