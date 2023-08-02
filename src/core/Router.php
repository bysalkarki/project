<?php

namespace app\core;

class Router
{
    public Request $request;

    protected array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, string|callable $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, string|callable $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            return 'NOT FOUND';
        }

        if (is_string($callback)) {
            $this->renderView($callback);
            exit;
        }

        return call_user_func($callback);
    }

    /**
     * @param string $view
     * @return array|bool|string
     */
    private function renderView(string $view): array|bool|string
    {
        $layout = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace("{{content}}", $viewContent, $layout);
    }

    protected function layoutContent(): bool|string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/../views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/../views/{$view}.php";
        return ob_get_clean();
    }
}