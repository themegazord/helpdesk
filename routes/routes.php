<?php

require_once 'router.php';

$router = new \routes\Router();


$router->addRoute('/', 'HomeController', 'index');
$router->addRoute('/cadastro', 'CadastroController', 'index');
$router->addRoute('/cadastro-process', 'CadastroController', 'processaDadosCadastro');
$router->addRoute('/cadastro/validaemail', 'CadastroController', 'validaEmail');

// Get the requested URL from the user
$requestUrl = $_SERVER['REQUEST_URI'];

// Remove query string from the URL
$requestUrl = strtok($requestUrl, '?');

// Route the request
$router->route($requestUrl);