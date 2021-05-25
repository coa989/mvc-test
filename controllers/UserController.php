<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\models\Post;
use app\models\User;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{

    /**
     * @var User
     */
    private User $user;

    /**
     * UserController constructor.
     * @throws ForbiddenException
     */
    public function __construct()
    {
        $this->user = new User();
        if (!$this->user->isAdmin() && !$this->user->isOwner($_GET['id'])) {
            throw new ForbiddenException();
        }
    }

    /**
     * @return string|string[]
     */
    public function index()
    {
        $users = $this->user->getAll();

        return $this->render('users/index', [
            'users' => $users
        ]);
    }

    /**
     * @return string|string[]
     */
    public function show()
    {
        $user = $this->user->findOne(['id' => $_GET['id']]);
        return $this->render('users/show', [
            'user' => $user,
            'users' => $this->user
        ]);
    }

    /**
     * @param Request $request
     * @return string|string[]
     */
    public function create(Request $request)
    {
        if ($request->isPost()) {
            $this->user->loadData($request->getBody());
            if ($this->user->validate() && $this->user->save()) {
                Application::$app->session->setFlash('success', 'User has been created.');
                Application::$app->response->redirect('/dashboard');
            }
        }
        return $this->render('users/create', [
            'user' => $this->user
        ]);
    }


    /**
     * @param Request $request
     * @return string|string[]
     */
    public function edit(Request $request)
    {
        $user = $this->user->findOne(['id' => $_GET['id']]);
        if ($request->isPost()) {
            $this->user->loadData($request->getBody());
            if ($this->user->validate() && $this->user->update($user->id)) {
                Application::$app->session->setFlash('success', 'User info has been updated.');
                if ($this->user->isAdmin()) {
                    Application::$app->response->redirect('/users');
                } else {
                    Application::$app->response->redirect('/');
                }
            }
        }
        return $this->render('users/edit', [
            'user' => $this->user,
            'users' => $user
        ]);
    }

    public function delete()
    {
        if ($this->user->delete($_GET['id'])) {
            Application::$app->session->setFlash('success', 'User has been deleted.');
            Application::$app->response->redirect('/users');
        }
    }

    public function posts()
    {
        $posts = (new Post())->find(['user_id' => $_GET['id']]);
        if (empty($posts)) {
            Application::$app->session->setFlash('failure', 'This user has no posts!');
        }
        return $this->render('/users/posts', [
            'posts' => $posts,
            'users' => $this->user
        ]);
    }
}