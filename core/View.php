<?php


namespace app\core;


class View
{

    public string $title = '';

    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
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