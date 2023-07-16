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
	$id = (int) \Utils\extractParam($uri, $pattern);       
	$query = fetch("SELECT * FROM task WHERE id = '$id';");
	header("Content-type","application/json");
	http_response_code(200);
	die(json_encode($query));	
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
