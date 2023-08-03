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
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            $this->response->setStatusCode('404');
            return $this->renderContent('NOT FOUND');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }

    /**
     * @param string $content
     * @return string
     */
    private function renderContent(string $content): string
    {
        $layout = $this->layoutContent();
        return str_replace("{{content}}", $content, $layout);
    }

    protected function layoutContent(): bool|string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
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