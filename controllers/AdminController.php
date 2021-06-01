<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\models\Comment;
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
        return $this->render('admin/index', [
            'users' => $users
        ]);
    }

    /**
     * @return string|string[]
     */
    public function users()
    {
        return $this->render('admin/users', [
            'users' => $users = $this->user->getAll()
        ]);
    }

    /**
     * @return string|string[]
     */
    public function posts()
    {

        return $this->render('admin/posts', [
            'posts' => (new Post())->getAll(),
            'users' => $this->user
        ]);
    }

    /**
     * @return string|string[]
     */
    public function comments()
    {
        return $this->render('admin/comments', [
            'comments' => (new Comment())->find(['post_id' => $_GET['id']]),
            'users' => new User()
        ]);
    }

    public function approvePost()
    {
        if ((new Post)->approve()) {
            Application::$app->session->setFlash('success', 'Post has been approved.');
            $id = $_GET['id'];
            Application::$app->response->redirect("/posts/show?id=$id");
        }
    }

    public function approveComment()
    {
        if ((new Comment())->approve()) {
            Application::$app->session->setFlash('success', 'Post has been approved.');
            $id = $_GET['post'];
            Application::$app->response->redirect("/admin/comments?id=$id");
        }
    }
}   