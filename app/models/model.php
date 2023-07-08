<?php 

namespace Models;

class Model {
    protected string $tableName;
    function __construct($table)
    {
        $this->tableName = $table;
    }

    static function get($tableName){
        return MYSQL_CONN->query("SELECT * FROM $tableName;")->fetch_all(MYSQLI_ASSOC);
    }
}