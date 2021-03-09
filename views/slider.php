<?php
    include "connection.php";

    $query = "SELECT * FROM slider";
    $ressult = $connection->query($query);
    $resFetch = $ressult->fetchAll();
    //var_dump($resFetch);
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($resFetch);
?>