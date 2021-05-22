<?php


namespace app\controllers;


use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\models\User;

/**
 * Class AdminController
 * @package app\controllers
 */
class AdminController extends Controller
{
    /**
     * @var User
     */
    private User $user;

    /**
     * AdminController constructor.
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
    public function index()
    {
        $users = $this->user->getAll();
        return $this->render('admin/dashboard', [
            'users' => $users
        ]);
    }
}   