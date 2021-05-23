<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AdminController;
use app\controllers\AuthController;
use app\controllers\PostController;
use app\controllers\SiteController;
use app\controllers\UserController;
use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$app = new Application(dirname(__DIR__));

/** AdminController routes */
$app->router->get('/dashboard', [AdminController::class, 'index']);

/** UserController routes */
// TODO add /user to path
$app->router->get('/show', [UserController::class, 'show']);
$app->router->get('/create', [UserController::class, 'create']);
$app->router->post('/create', [UserController::class, 'create']);
$app->router->get('/edit', [UserController::class, 'edit']);
$app->router->post('/edit', [UserController::class, 'edit']);
$app->router->get('/delete', [UserController::class, 'delete']);

/** AuthController routes */
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

/** PostController routes */
$app->router->get('/', [PostController::class, 'index']);
$app->router->get('/posts/create', [PostController::class, 'create']);
$app->router->post('/posts/create', [PostController::class, 'create']);

$app->run();