<?php 

namespace Controllers;

use Models\Model;
use Models\Task;

class TaskController extends Controller {
    public string $name;
    public function __construct()
    {
        parent::__construct();
    }

    public function getById($server, $route) {
        $uri = $server['REQUEST_URI'];
        $pattern = $route->path;

        \Utils\extractParam($uri, $pattern);
        \Utils\dd([$route, $uri,  \Utils\extractParam($uri, $pattern)]);
    }

    public function index($server){
        \Utils\dd([Model::get('tasks')]);
    }

    public function create($server){
        $data = $this->getBody();
        $name = $data->name;
        $description = $data->description;
        $completed = (int) $data->completed;
        $newTask = new Task($name, $description, $completed);
        $newTask->save();

        die();
    }

    public function update($server){
        return "update";
    }

    public function delete($server){
        return "delete";
    }
}