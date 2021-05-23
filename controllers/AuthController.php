<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\UserLogin;
use app\models\UserRegister;

/**
 * Class AuthController
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return string|string[]
     */
    public function register(Request $request)
    {
        $user = new UserRegister();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->register()) {
                Application::$app->response->redirect('/login');
            }
        }
        return $this->render('auth/register', [
            'model' => $user
        ]);
    }

    /**
     * @param Request $request
     * @return string|string[]
     */
    public function login(Request $request)
    {
        $user = new UserLogin();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->login()) {
                Application::$app->session->setFlash('login', 'You are successfully login');
                if ((new User())->isAdmin()) {
                    Application::$app->response->redirect('/dashboard');
                    // nemam ideju zasto je doslo do toga da moram da stavim die() !!!
                    die();
                } else {
                    Application::$app->response->redirect('/');
                }
            }
        }
        return $this->render('auth/login', [
            'model' => $user
        ]);
    }

    public function logout()
    {
        Application::$app->session->remove('user');
        Application::$app->response->redirect('/login');
    }

}