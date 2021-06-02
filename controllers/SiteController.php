<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Email;
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
    public function index()
    {
        return $this->render('home');
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

    /**
     * @param Request $request
     * @return string|string[]
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function contact(Request $request)
    {
        $contact = new Contact();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->save()) {
                (new Email())->contact($contact->email, $contact->name, $contact->subject, $contact->message);
                Application::$app->response->redirect('/posts');
            }
        }
        return $this->render('contact', [
            'contact' => $contact
        ]);
    }
}