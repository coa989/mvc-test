<?php


namespace app\core;


class View
{

    public function renderView($view)
    {
        $viewContent = $this->renderOnlyView($view);
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_PATH."/views/$view.php";
        return ob_get_clean();
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_PATH."/views/layouts/main.php";
        return ob_get_clean();
    }
}