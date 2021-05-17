<?php


namespace app\core;


use app\core\exceptions\NotFoundException;

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

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        // ako callback ne postoji u routes array vracamo NotFoundException
        if ($callback === false) {
            throw new NotFoundException();
        }
        // ako je string vracamo view sa tim stringom
        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }
//        ako je array tj u formatu [controller, method] instanciramo controller
//        i dodeljujemo objekat callbacku na poziciji 0
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
//      pokrecemo callback pomocu call_user_func, saljemo i request da bi mogli da ga koristimo u metodama kontrolera
        return call_user_func($callback, $this->request);
    }
}