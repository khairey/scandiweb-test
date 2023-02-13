<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/config.php';
spl_autoload_register(function ($class_name) {
    include __DIR__ . '/../'.$class_name . '.php';
});
use src\config\Router;
use src\controllers\ProductController;
use src\config\Database;

$database = new Database();
$router = new Router($database);

$router->request('/', [ProductController::class, 'index']);
$router->resolve();