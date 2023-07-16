<?php 

$connection = new mysqli("localhost", "carlos", "123456",'todo');

if($connection->connect_errno) {
    echo "failed to connect";
    die();
}

defined("MYSQL_CONN") ? null : define("MYSQL_CONN", $connection);

function fetch(string $query) {
	$result = mysqli_query(MYSQL_CONN, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
	}
	return $data;
}
