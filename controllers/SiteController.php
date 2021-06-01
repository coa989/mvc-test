<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\models\Contact;
use app\models\User;

/**
 * Class ProfileController
 * @package app\controllers
 */
class SiteController extends Controller
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
    public function profile()
    {
        $user = (new User())->findOne(['id' => $_GET['id']]);
        return $this->render('users/profile', [
            'user' => $user
        ]);
    }

    public function contact(Request $request)
    {
        $contact = new Contact();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->save()) {
                // TODO send contact form via email
                Application::$app->response->redirect('/posts');
            }
        }
        return $this->render('contact', [
            'contact' => $contact
        ]);
    }
}