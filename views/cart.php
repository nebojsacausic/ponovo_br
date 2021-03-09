<?php

session_start();

if (isset($_POST['setCartSession'])) {

    if (isset($_SESSION['users'])) {
        if ($_SESSION['users']->role_id == "2") {
            $id = $_POST['idProduct'];
            $kolicina = 1;

            if (empty($_SESSION['cart'])) {

                $_SESSION['cart'] = array(0 => array('id' => $id, 'kolicina' => $kolicina));
            } else {
                $status = false;
                foreach ($_SESSION['cart'] as $key => $el) {
                    if ($el['id'] === $id) {
                        $_SESSION['cart'][$key]['kolicina'] += 1;
                        $status = true;
                        break;
                    }
                }
                if ($status) {
                    $status = false;
                } else {
                    $addNew2 = array('id' => $id, 'kolicina' => $kolicina);
                    array_push($_SESSION['cart'], $addNew2);
                }
            }


            echo json_encode($_SESSION['cart']);
        }
    } else {
        header("Location: ../login.php");
    }
    // session_destroy();

}




if (isset($_POST['setIdDelete'])) {

    if (isset($_SESSION['users'])) {
        if ($_SESSION['users']->role_id == "2") {
            //$id = $_POST['idDelete'];

            //var_dump($id);


            if (isset($_SESSION['cart'])) {

                include "connection.php";

                $arrObj = $_SESSION['cart']; //3
                // var_dump($arrObj);
                $func = function ($product) {
                    $id = $_POST['idDelete'];
                    return $product['id'] != $id;
                };
                $arrObjects = array_filter($arrObj, $func);
                $_SESSION['cart'] = $arrObjects;


                $func = function ($product) {
                    // var_dump($product);
                    return $product['id'];
                };
                $arrId = array_map($func, $_SESSION['cart']);
                // var_dump($arrId);
                $stringId = implode(',', $arrId);
                // var_dump($stringId);

                $array = array_map('intval', explode(',', $stringId));
                $array = implode("','", $array);

                // var_dump($array);

                $querry = "SELECT * FROM products INNER JOIN pictures ON products.id_product = pictures.id_product
                            WHERE products.id_product IN ('" . $array . "')";
                $ressult = $connection->query($querry);
                $resFetch = $ressult->fetchAll();


                foreach ($resFetch as $product) {
                    foreach ($arrObjects as $prodFromSession) {
                        if ($product->id_product == $prodFromSession['id']) {
                            $product->kolicina = $prodFromSession['kolicina'];
                        }
                    }
                }


                echo json_encode($resFetch);
            }
        }
    } else {
        header("Location: ../login.php");
    }
    // session_destroy();

}
