<?php

namespace app\core;

/**
 * Class Controller
 * @package app\core
 */
class Controller
{
    /**
     * @param $view
     * @param array $params
     * @return string|string[]
     */
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }
}