<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ForbiddenException;
use app\core\Request;
use app\models\Comment;
use app\models\Post;
use app\models\User;

/**
 * Class PostCommentController
 * @package app\controllers
 */
class PostCommentController extends Controller
{
    /**
     * @param Request $request
     * @return string|string[]
     */
    public function create(Request $request)
    {
        $comments = new Comment();
        if ($request->isPost()) {
            $comments->loadData($request->getBody());
            $post = (new Post())->findOne(['id' => $comments->post_id]);
            $comment = $comments->find(['post_id' => $comments->post_id]);
            if ($comments->validate() && $comments->save()) {
                Application::$app->session->setFlash('success', 'Comment has been added, it will be visible when admin approves it');
                Application::$app->response->redirect("/posts/show?id=$post->id");
            }
            return $this->render('/posts/show', [
                'post' => $post,
                'users' => new User(),
                'comment' =>$comments,
                'comments' => $comment
            ]);
        }
        return $this->render('/posts/show', [
            'comment' => $comments
        ]);
    }

    /**
     * @param Request $request
     * @return string|string[]
     * @throws ForbiddenException
     */
    public function edit(Request $request)
    {
        $comments = new Comment();
        $comment = $comments->findOne(['id' => $_GET['id']]);
        $user = new User();
        if (!$user->isOwner($comment->user_id) && !$user->isAdmin()) {
            throw new ForbiddenException();
        }
        if ($request->isPost()) {
            $comments->loadData($request->getBody());
            if ($comments->validate() && $comments->update($comment->id)) {
                Application::$app->session->setFlash('success', 'Comment has been updated, it will be visible when admin approves it');
                if ($user->isOwner($comment->user_id)) {
                    Application::$app->response->redirect("/posts/show?id=$comment->post_id");
                } else {
                    Application::$app->response->redirect("/comments?id=$comment->post_id");
                }
            }
        }
        return $this->render('/comments/edit', [
            'comments' => $comment
        ]);
    }

    /**
     * @throws ForbiddenException
     */
    public function delete()
    {
        $comments = new Comment();
        $comment = $comments->findOne(['id' => $_GET['id']]);
        $user = new User();
        if (!$user->isOwner($comment->user_id) && !$user->isAdmin()) {
            throw new ForbiddenException();
        }
        if ($comments->delete($_GET['id'])) {
            Application::$app->session->setFlash('success', 'Comment has been deleted.');
            if ($user->isOwner($comment->user_id)) {
                Application::$app->response->redirect("/posts/show?id=$comment->post_id");
            } else {
                Application::$app->response->redirect("/comments?id=$comment->post_id");
            }
        }
    }
}