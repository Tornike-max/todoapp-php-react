<?php

header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH");
header("Access-Control-Allow-Headers: *");

use app\controllers\AuthController;
use app\controllers\Controller;
use app\core\Application;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application();

// $app->router->get('/login', [AuthController::class, 'login']);
// $app->router->get('/register', [AuthController::class, 'register']);

$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->post('/addtodo', [Controller::class, 'addTodo']);
$app->router->get('/gettodos', [Controller::class, 'getTodos']);
$app->router->get('/gettodo', [Controller::class, 'gettodo']);
$app->router->post('/update', [Controller::class, 'update']);
$app->router->post('/delete', [Controller::class, 'delete']);




$app->router->resolve();
