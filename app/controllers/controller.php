<?php 
namespace Controllers;

class Controller {
    public string $baseRoute;
    
    public function __construct(){}

    protected function getBody(){
        return json_decode(
            file_get_contents("php://input")
        );
    }
}