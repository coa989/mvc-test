<?php


namespace app\controllers;


use app\core\Controller;
use app\models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = (new User())->findOne(['id' => $_GET['id']]);
        return $this->render('index', [
            'user' => $user
        ]);
    }
}