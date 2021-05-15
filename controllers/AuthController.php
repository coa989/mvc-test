<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validateRegister() && $user->save()) {
                Application::$app->response->redirect('/login');
            }
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function login(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validateLogin()) {
                if ($user->isAdmin()) {
                    Application::$app->response->redirect('/dashboard');
                } else {
                    Application::$app->response->redirect('/');
                }
            }
        }
        return $this->render('login', [
            'model' => $user
        ]);
    }

    public function logout()
    {
        Application::$app->session->remove('user');
        Application::$app->response->redirect('/login');
    }

}