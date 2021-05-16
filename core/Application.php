<?php

namespace app\core;

class Application
{
    public static string $ROOT_PATH;
    public static Application $app;

    public Request $request;
    public Response $response;
    public Router $router;
    public View $view;
    public Controller $controller;
    public Database $db;
    public Session $session;

    /**
     * Application constructor
     * @param $rootPath
     */
    public function __construct($rootPath)
    {
        self::$app = $this;
        self::$ROOT_PATH = $rootPath;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->controller = new Controller();
        $this->db = new Database();
        $this->session = new Session();
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }
}