<?php

require_once 'router.php';

use app\infrastructe\mock\HomeNavLinks\NavLinks;
use app\http\controllers\HomeController;

$router = new \routes\Router();

$homeDi = [NavLinks::class];

$router->addRoute('/', HomeController::class, 'index', $homeDi);

// Get the requested URL from the user
$requestUrl = $_SERVER['REQUEST_URI'];

// Remove query string from the URL
$requestUrl = strtok($requestUrl, '?');

// Route the request
$router->route($requestUrl);