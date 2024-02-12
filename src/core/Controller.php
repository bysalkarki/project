<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';
    public array $middleware = [];

    public function render(string $view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middleware[] = $middleware;
    }


}