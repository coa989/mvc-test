<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AdminController;
use app\controllers\AuthController;
use app\controllers\PostController;
use app\controllers\ProfileController;
use app\controllers\UserController;
use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$app = new Application(dirname(__DIR__));

/** AdminController routes */
$app->router->get('/dashboard', [AdminController::class, 'index']);
$app->router->get('/users', [AdminController::class, 'users']);
$app->router->get('/posts', [AdminController::class, 'posts']);
$app->router->get('/posts/approve', [AdminController::class, 'approvePost']);
/** UserController routes */
$app->router->get('/users/show', [UserController::class, 'show']);
$app->router->get('/users/create', [UserController::class, 'create']);
$app->router->post('/users/create', [UserController::class, 'create']);
$app->router->get('/users/edit', [UserController::class, 'edit']);
$app->router->post('/users/edit', [UserController::class, 'edit']);
$app->router->get('/users/delete', [UserController::class, 'delete']);
/** AuthController routes */
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
/** PostController routes */
$app->router->get('/', [PostController::class, 'index']);
$app->router->get('/posts/show', [PostController::class, 'show']);
$app->router->get('/posts/create', [PostController::class, 'create']);
$app->router->post('/posts/create', [PostController::class, 'create']);
$app->router->get('/posts/edit', [PostController::class, 'edit']);
$app->router->post('/posts/edit', [PostController::class, 'edit']);
$app->router->get('/posts/delete', [PostController::class, 'delete']);
/** ProfileController routes */
$app->router->get('/profile', [ProfileController::class, 'index']);

$app->run();