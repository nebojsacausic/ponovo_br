<?php 
	
	include "connection.php";

	if(isset($_POST['postBrand'])){
        
        $id = $_POST['idBrand'];
        //echo $id;
        
        
        try{
            $query = 'SELECT * FROM `products` INNER JOIN pictures ON products.id_product = pictures.id_product WHERE id_brand = ?';
            $prepare = $connection->prepare($query);
            $prepare->bindParam(1, $id);
            $result = $prepare->execute();
            $res = $prepare->fetchAll();
            //var_dump($res);
            $status = 201;
            $items = $res;
    
        }
        catch(PDOException $ex){
            $items = "Error";
            $status = 500;
        }

        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($items);
    }
    else if(isset($_POST['postCat'])){
        
        $id = $_POST['idCat'];
        //echo $id;
        
        
        try{
            $query = 'SELECT * FROM `products` INNER JOIN pictures ON products.id_product = pictures.id_product WHERE id_category = ?';
            $prepare = $connection->prepare($query);
            $prepare->bindParam(1, $id);
            $result = $prepare->execute();
            $res = $prepare->fetchAll();
            //var_dump($res);
            $status = 201;
            $items = $res;
    
        }
        catch(PDOException $ex){
            $items = "Error";
            $status = 500;
        }

        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($items);
    }
    else if(isset($_POST['searchProd'])){

        $search = $_POST['search_content'];
        $search_content = "%".$search."%";

        
        try{
            $query = 'SELECT * FROM `products` INNER JOIN pictures ON products.id_product = pictures.id_product WHERE product_name like ?';
            $prepare = $connection->prepare($query);
            $prepare->bindParam(1, $search_content);
            $result = $prepare->execute();
            $res = $prepare->fetchAll();
            //var_dump($res);
            $status = 201;
    
        }
        catch(PDOException $ex){
            $res = "Error";
            $status = 500;
        }

        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($res);


    }
 ?>