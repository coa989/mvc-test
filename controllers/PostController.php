<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\models\Comment;
use app\models\Like;
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
            'users' => new User(),
        ]);
    }

    /**
     * @return string|string[]
     */
    public function show()
    {
        $post = $this->post->findOne(['id' => $_GET['id']]);
        $comments = new Comment();
        return $this->render('/posts/show', [
            'post' => $post,
            'users' => new User(),
            'comment' => $comments,
            'comments' => $comments->find(['post_id' => $post->id]),
            'likes' => new Like()
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
                Application::$app->session->setFlash('success', 'Post has been created, it will be visible when admin approves it.');
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
     * @throws ForbiddenException
     */
    public function edit(Request $request)
    {
        $post = $this->post->findOne(['id' => $_GET['id']]);
        $user = new User();
        if (!$user->isOwner($post->user_id) && !$user->isAdmin()) {
            throw new ForbiddenException();
        }
        if ($request->isPost()) {
            $this->post->loadData($request->getBody());
            if ($this->post->validate() && $this->post->update($_GET['id'])) {
                Application::$app->session->setFlash('success', 'Post has been updated, it will be visible when admin approves it.');
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

    /**
     * @throws ForbiddenException
     */
    public function delete()
    {
        $post = $this->post->findOne(['id' => $_GET['id']]);
        $user = new User();
        if (!$user->isOwner($post->user_id) && !$user->isAdmin()) {
            throw new ForbiddenException();
        }
        if ($this->post->delete($_GET['id'])) {
            Application::$app->session->setFlash('success', 'Post has been deleted.');
            if ((new User())->isAdmin()) {
                Application::$app->response->redirect('/posts');
            } else {
                Application::$app->response->redirect('/');
            }
        }
    }
}