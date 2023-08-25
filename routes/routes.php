<?php

require_once 'router.php';

$router = new \routes\Router();


$router->addRoute('/', 'HomeController', 'index');
$router->addRoute('/cadastro', 'CadastroController', 'index');
$router->addRoute('/cadastro-process', 'CadastroController', 'processaDadosCadastro');
$router->addRoute('/cadastro/validaemail', 'CadastroController', 'validaEmail');
$router->addRoute('/cadastro/validaemail-process', 'CadastroController', 'procassaDadosValidaEmail');
$router->addRoute('/login', 'LoginController', 'index');
$router->addRoute('/login-process', 'LoginController', 'processaDadosLogin');
$router->addRoute('/dashboard', 'DashboardController', 'index');

// Get the requested URL from the user
$requestUrl = $_SERVER['REQUEST_URI'];


// Route the request
$router->route($requestUrl);