<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Codeir\BelajarPHPMvc\App\Router;
use Codeir\BelajarPHPMvc\Controller\HomeController;
use Codeir\BelajarPHPMvc\Controller\UserController;
use Codeir\BelajarPHPMvc\Config\Database;

Database::getConnection('prod');

// home controller
Router::add('GET', '/', HomeController::class, 'index', []);

// user controller
Router::add('GET', '/users/register', UserController::class, 'register', []);
Router::add('POST', '/users/register', UserController::class, 'postRegister', []);

Router::run();