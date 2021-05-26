<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\models\User;

/**
 * Class ProfileController
 * @package app\controllers
 */
class UserProfileController extends Controller
{
    /**
     * ProfileController constructor.
     * @throws ForbiddenException
     */
    public function __construct()
    {
        if (Application::$app->session->isGuest()) {
            throw new ForbiddenException();
        }
    }

    /**
     * @return string|string[]
     */
    public function index()
    {
        $user = (new User())->findOne(['id' => $_GET['id']]);
        return $this->render('users/profile', [
            'user' => $user
        ]);
    }
}