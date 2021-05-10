<?php


namespace app\core;


class Router
{
    public Request $request;
    public Response $response;

    public array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
        }
        
        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        return call_user_func($callback);
    }
}