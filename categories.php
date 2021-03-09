<?php
    include "views/connection.php";

    $querry = "select * from categories";
	$ressult = $connection->query($querry);
    $resFetch = $ressult->fetchAll();

    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($resFetch);
?>