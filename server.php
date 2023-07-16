<?php

require_once __DIR__."/config/config.php";


//=============================================================


$input = "/task/1";
$pattern = "/^\/task\/(\d+)$/";
$matches = array();

//if (preg_match($pattern, $input, $matches)) {
//    $number = $matches[1];
//    echo $number; // Output: 1
//} else {
//    echo "No match found.";
//}

//die;

//$sql = "SELECT * FROM task;";
//$result = fetch($sql);

//print_r($result);
//die;


//===========================================================
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
