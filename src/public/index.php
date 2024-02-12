<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'host'     => $_ENV['DB_HOST'],
        'port'     => $_ENV['DB_PORT'],
        'database' => $_ENV['DB_DATABASE']
    ]
];
$app    = new Application(
    dirname(__DIR__), $config
);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->post('/login', [AuthController::class, 'handleLogin']);
$app->router->post('/registration', [AuthController::class, 'handleRegister']);
$app->router->get('/registration', [AuthController::class, 'registration']);

$app->router->get('/department',[\app\controllers\DepartmentController::class,'index']);
$app->router->post('/department',[\app\controllers\DepartmentController::class,'store']);
$app->router->post('/department/delete',[\app\controllers\DepartmentController::class,'remove']);
$app->run();