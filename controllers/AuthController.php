<?php


namespace app\controllers;


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
            if ($user->validate() && $user->save()) {
                return 'Success';
            }
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function login(Request $request)
    {
        if ($request->isPost()) {

        }
        return $this->render('login');
    }

}