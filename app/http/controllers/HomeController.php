<?php

namespace app\http\controllers;
use app\infrastructe\mock\HomeNavLinks\NavLinks;

class HomeController {
    public function __construct(
        private readonly NavLinks $navLinks
    ){}
    public function index(): void {
        $data = [
            'navlinks' => $this->navLinks->links()
        ];
        include 'resources/views/Home/Home.php';
    }
}