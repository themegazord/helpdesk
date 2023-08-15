<?php

require_once 'router.php';

$router = new Router();

$router->addRoute('/', 'HomeController', 'index');

// Get the requested URL from the user
$requestUrl = $_SERVER['REQUEST_URI'];

// Remove query string from the URL
$requestUrl = strtok($requestUrl, '?');

// Route the request
$router->route($requestUrl);