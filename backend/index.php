<?php

// header('Access-Control-Allow-Origin: http://localhost:8080');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH");
header("Access-Control-Allow-Headers: Content-Type");

use app\controllers\Controller;
use app\core\Application;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application();

$app->router->get('/login', [Controller::class, 'login']);
$app->router->get('/register', [Controller::class, 'register']);

$app->router->post('/login', [Controller::class, 'login']);
$app->router->post('/register', [Controller::class, 'register']);

$app->router->post('/addtodo', [Controller::class, 'addTodo']);
$app->router->get('/gettodos', [Controller::class, 'getTodos']);
$app->router->get('/gettodo', [Controller::class, 'getTodo']);




$app->router->resolve();
