<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\models\User;

class UserController extends Controller
{   

    private User $user;
    
    public function __construct()
    {
        $this->user = new User();
        if (!$this->user->isAdmin()) {
            throw new ForbiddenException();
        }
    }

    public function dashboard()
    {
        $users = (new User())->getAll();
        return $this->render('dashboard', [
            'users' => $users
        ]);
    }

    public function show()
    {
        $user = (new User())->findOne(['id' => $_GET['id']]);
        return $this->render('show', [
            'user' => $user
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validateCreate() && $user->save()) {
                Application::$app->response->redirect('/dashboard');
            }
        }
        return $this->render('create', [
            'user' => $user
        ]);
    }


    public function edit(Request $request)
    {
        $users = new User();
        $user = $users->findOne(['id' => $_GET['id']]);
        if ($request->isPost()) {
            $users->loadData($request->getBody());
            if ($users->validateUpdate() && $users->update($user->id)) {
                Application::$app->response->redirect('/dashboard');
            }
        }

        return $this->render('edit', [
            'user' => $user
        ]);
    }

    public function delete()
    {
        $user = new User();
        if ($user->delete($_GET['id'])) {
            Application::$app->response->redirect('/dashboard');
        }
    }
}