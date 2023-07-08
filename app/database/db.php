<?php 

$connection = new mysqli("localhost", "carlos", "123456",'todo');

if($connection->connect_errno) {
    echo "failed to connect";
    die();
}

defined("MYSQL_CONN") ? null : define("MYSQL_CONN", $connection);