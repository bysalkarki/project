<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;

    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, string|callable|array $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, string|callable|array $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            $this->response->setStatusCode('404');
            return $this->renderContent('NOT FOUND');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request);
    }

    /**
     * @param string $content
     * @return string
     */
    public function renderContent(string $content): string
    {
        $layout = $this->layoutContent();

        $output = <<< Start
            <main class="px-3">
                <h1>$content</h1>
                 <p class="lead">
                    <a href="/" class="btn btn-lg btn-light fw-bold border-white bg-white">Go To Home</a>
                </p>
            </main>
    Start;

        return str_replace("{{content}}", $output, $layout);
    }

    protected function layoutContent(): bool|string
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @return string
     */
    public function renderView(string $view, array $params = []): string
    {
        $layout = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace("{{content}}", $viewContent, $layout);
    }

    protected function renderOnlyView($view, array $params): bool|string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/{$view}.php";
        return ob_get_clean();
    }
}