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
       
	$result = \Utils\extractParam($uri, $pattern);
	\Utils\dd(["rota" => $route,"url" =>  $uri,"result" => $result] );
    }

    public function index($server){
        \Utils\dd([Model::get('task')]);
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
