<?php

include "connection.php";

    $querry = "SELECT * FROM products INNER JOIN pictures ON products.id_product = pictures.id_product
                                        INNER JOIN categories ON products.id_category = categories.id_category
                                        INNER JOIN brand ON products.id_brand = brand.id_brand";
    $ressult = $connection->query($querry);
    $resFetch = $ressult->fetchAll();
    //var_dump($resFetch);
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($resFetch);

?>