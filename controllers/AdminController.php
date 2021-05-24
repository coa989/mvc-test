<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\models\Post;
use app\models\User;

/**
 * Class AdminController
 * @package app\controllers
 */
class AdminController extends Controller
{
    /**
     * @var User
     */
    private User $user;

    /**
     * AdminController constructor.
     * @throws ForbiddenException
     */
    public function __construct()
    {
        $this->user = new User();
        if (!$this->user->isAdmin()) {
            throw new ForbiddenException();
        }
    }

    /**
     * @return string|string[]
     */
    public function index()
    {
        $users = $this->user->getAll();
        return $this->render('admin/dashboard', [
            'users' => $users
        ]);
    }

    /**
     * @return string|string[]
     */
    public function users()
    {
        $users = $this->user->getAll();

        return $this->render('admin/users', [
            'users' => $users
        ]);
    }

    /**
     * @return string|string[]
     */
    public function posts()
    {
        $posts = (new Post())->getAll();
        return $this->render('admin/posts', [
            'posts' => $posts,
            'users' => $this->user
        ]);
    }

    public function approvePost()
    {
        if ((new Post)->approve()) {
            $id = $_GET['id'];
            Application::$app->response->redirect("show?id=$id");
        }
    }
}   