<?php

require_once 'router.php';

$router = new \routes\Router();


$router->addRoute('/', 'HomeController', 'index');
$router->addRoute('/cadastro', 'CadastroController', 'index');
$router->addRoute('/cadastro-process', 'CadastroController', 'processaDadosCadastro');
$router->addRoute('/cadastro/validaemail', 'CadastroController', 'validaEmail');
$router->addRoute('/cadastro/validaemail-process', 'CadastroController', 'procassaDadosValidaEmail');

// Get the requested URL from the user
$requestUrl = $_SERVER['REQUEST_URI'];


// Route the request
$router->route($requestUrl);