<?php

require_once __DIR__ . '/vendor/autoload.php';

// Get the URL from the query string
$url = isset($_GET['url']) ? $_GET['url'] : '/';

// Define your routes and corresponding controllers
$routes = [
    '/' => 'App\controllers\IndexController',
];
// Check if the requested route exists
if (array_key_exists($url, $routes)) {
    $controllerName = $routes[$url];
    $controller = new $controllerName();
    $controller->index(); // Assuming all controllers have an "index" method
} else {
    // Handle 404 Not Found
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found';
}
