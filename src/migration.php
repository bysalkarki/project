<?php


require_once __DIR__ . '/vendor/autoload.php';

use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
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
    __DIR__, $config
);

$app->db->applyMigrations();