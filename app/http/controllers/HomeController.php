<?php

namespace app\http\controllers;

class HomeController {
    public function __construct(
        private readonly NavLinks $navLinks
    ){}
    public function index() {
        $navlinks = $this->navLinks->links();
        include 'resources/views/Home/Home.php';
    }
}