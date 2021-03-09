<?php

include "connection.php";

    $querry = "SELECT * FROM questionnaire";
    $ressult = $connection->query($querry);
    $resFetch = $ressult->fetchAll();
    //var_dump($resFetch);
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($resFetch);