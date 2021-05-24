<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Post;
use app\models\User;

/**
 * Class PostController
 * @package app\controllers
 */
class PostController extends Controller
{
    private Post $post;
    /**
     * PostController constructor.
     * Checks if user is logged in
     */
    public function __construct()
    {
        if (Application::$app->session->isGuest()) {
            Application::$app->response->redirect('/login');
        }
        $this->post = new Post();
    }

    /**
     * @return string|string[]
     */
    public function index()
    {
        $posts = $this->post->getAll();
        return $this->render('home', [
            'posts' => $posts,
            'users' => new User()
        ]);
    }

    /**
     * @return string|string[]
     */
    public function show()
    {
        $post = $this->post->findOne(['id' => $_GET['id']]);
        return $this->render('/posts/show', [
            'post' => $post,
            'users' => new User()
        ]);
    }

    /**
     * @param Request $request
     * @return string|string[]
     */
    public function create(Request $request)
    {
        $post = new Post();
        if ($request->isPost()) {
            $post->loadData($request->getBody());
            if ($post->validate() && $post->save()) {
                Application::$app->response->redirect('/');
            }
        }
        return $this->render('posts/create', [
            'post' => $post
        ]);
    }

    /**
     * @param Request $request
     * @return string|string[]
     */
    public function edit(Request $request)
    {
        $post = $this->post->findOne(['id' => $_GET['id']]);
        if ($request->isPost()) {
            $this->post->loadData($request->getBody());
            if ($this->post->validate() && $this->post->update($_GET['id'])) {
                if ((new User())->isAdmin()) {
                    Application::$app->response->redirect('/posts');
                } else {
                    Application::$app->response->redirect('/');
                }
            }
        }
        return $this->render('posts/edit', [
            'post' => $post,
            'posts' => $this->post
        ]);
    }

    public function delete()
    {
        if ($this->post->delete($_GET['id'])) {
            if ((new User())->isAdmin()) {
                Application::$app->response->redirect('/posts');
            } else {
                Application::$app->response->redirect('/');
            }
        }
    }
}