<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
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
        if (!$this->user->isAdmin()) {
            throw new ForbiddenException();
        }
    }

    /**
     * @return string|string[]
     */
    public function dashboard()
    {
        $users = $this->user->getAll();
        return $this->render('dashboard', [
            'users' => $users
        ]);
    }

    /**
     * @return string|string[]
     */
    public function show()
    {
        $user = $this->user->findOne(['id' => $_GET['id']]);
        return $this->render('show', [
            'user' => $user
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
                Application::$app->response->redirect('/dashboard');
            }
        }
        return $this->render('create', [
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
                Application::$app->response->redirect('/dashboard');
            }
        }

        return $this->render('edit', [
            'user' => $this->user,
            'users' => $user
        ]);
    }

    /**
     *
     */
    public function delete()
    {
        if ($this->user->delete($_GET['id'])) {
            Application::$app->response->redirect('/dashboard');
        }
    }
}