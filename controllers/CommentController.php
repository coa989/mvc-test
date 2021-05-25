<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Comment;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $comment = new Comment();
        if ($request->isPost()) {
            $comment->loadData($request->getBody());
            if ($comment->validate() && $comment->save()) {
                Application::$app->session->setFlash('success', 'Comment has been added, it will be visible when admin approves it');
                Application::$app->response->redirect('/');
            }
        }
        return $this->render('/posts/show', [
            'comments' => $comment
        ]);
    }
}