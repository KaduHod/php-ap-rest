<?php 

namespace Models;

use Models\Model;

class Task extends Model {
    public string $name;
    public string $description;
    public bool $completed;
    
    function __construct(string $name, string $description = "", bool $completed = false)
    {
        parent::__construct("tasks");
        $this->name = $name;
        $this->description = $description;
        $this->completed = (int) $completed;
    }

    public function save() {
        $completed = (int) $this->completed;
        $query = "INSERT INTO tasks (name, description, completed) values ('$this->name', '$this->description', $completed);";

        \Utils\dd([$query]);

        MYSQL_CONN->query($query);
    }
}