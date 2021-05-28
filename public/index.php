<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AdminController;
use app\controllers\AuthController;
use app\controllers\PostCommentController;
use app\controllers\PostController;
use app\controllers\PostLikeController;
use app\controllers\UserProfileController;
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
$app->router->get('/comments', [AdminController::class, 'comments']);
$app->router->get('/comments/approve', [AdminController::class, 'ApproveComment']);
/** UserController routes */
$app->router->get('/users/show', [UserController::class, 'show']);
$app->router->get('/users/create', [UserController::class, 'create']);
$app->router->post('/users/create', [UserController::class, 'create']);
$app->router->get('/users/edit', [UserController::class, 'edit']);
$app->router->post('/users/edit', [UserController::class, 'edit']);
$app->router->get('/users/delete', [UserController::class, 'delete']);
$app->router->get('/users/posts', [UserController::class, 'posts']);
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
/** CommentController routes */
$app->router->post('/comments/create', [PostCommentController::class, 'create']);
$app->router->get('/comments/edit', [PostCommentController::class, 'edit']);
$app->router->post('/comments/edit', [PostCommentController::class, 'edit']);
$app->router->get('/comments/delete', [PostCommentController::class, 'delete']);

$app->router->post('/likes/create', [PostLikeController::class, 'create']);
$app->router->post('/likes/delete', [PostLikeController::class, 'delete']);
/** ProfileController routes */
$app->router->get('/profile', [UserProfileController::class, 'index']);

$app->run();