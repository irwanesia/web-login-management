<?php

// 1. router sederhana
// $path = "/index";

// if (isset($_SERVER['PATH_INFO'])) {
//     $path = $_SERVER['PATH_INFO'];
// }

// require __DIR__ . '/../app/View' . $path . '.php';

// 2. router kompleks
require_once __DIR__ . '/../vendor/autoload.php';

use Codeir\BelajarPHPMvc\App\Router;
use Codeir\BelajarPHPMvc\Controller\HomeController;
use Codeir\BelajarPHPMvc\Controller\ProductController;
use Codeir\BelajarPHPMvc\Middleware\AuthMiddleware;

Router::add('GET', '/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)', ProductController::class, 'categories');

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);

Router::run();