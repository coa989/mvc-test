<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = (new Post())->getAll();
        return $this->render('home', [
            'posts' => $posts
        ]);
    }

    public function create(Request $request)
    {
        $post = new Post();
        if ($request->isPost()) {
            $post->loadData($request->getBody());
            if ($post->validate() && $post->save()) {
                Application::$app->response->redirect('/');
            }
        }
        return $this->render('posts/create', [
            'post' => $post
        ]);
    }
}