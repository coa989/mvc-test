<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Like;

/**
 * Class PostLikeController
 * @package app\controllers
 */
class PostLikeController extends Controller
{
    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $like = new Like();
            $like->loadData($request->getBody());
            if ($like->save()) {
                Application::$app->response->redirect("/posts/show?id=$like->post_id");
            }
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $likes = new Like();
        $likes->loadData($request->getBody());
        $like = $likes->findOne(['post_id' => $likes->post_id, 'user_id' => $likes->user_id]);
        if ($likes->delete($like->id)) {
            Application::$app->response->redirect("/posts/show?id=$like->post_id");
        }
    }
}