<?php
require_once __DIR__."/config/config.php";
use Routes\Router;
use Controllers\TaskController;

// Serve the requested file if it exists
if (file_exists(__DIR__ . $_SERVER['REQUEST_URI']) && !is_dir(__DIR__ . $_SERVER['REQUEST_URI'])) {
    return false;
}
$router = new Router();
$router->get("task", TaskController::class, "index");
$router->get("task/:num", TaskController::class, "getById");
$router->post("task/:num", TaskController::class, "create");
$router->put("task/:num", TaskController::class, "update");
$router->delete("task/:num", TaskController::class, "delete");
$router->handleRequest($_SERVER);
