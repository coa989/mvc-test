<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\UserController;
use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/dashboard', [SiteController::class, 'dashboard']); // change to AuthController ???

$app->router->get('/show', [UserController::class, 'show']);
$app->router->get('/create', [UserController::class, 'create']);
$app->router->post('/create', [UserController::class, 'create']);
$app->router->get('/edit', [UserController::class, 'edit']);
$app->router->post('/edit', [UserController::class, 'edit']);
$app->router->get('/delete', [UserController::class, 'delete']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

$app->run();