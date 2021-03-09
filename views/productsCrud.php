<?php

include "connection.php";

if(isset($_POST['add_item_btn'])){
    
    $title = $_POST['add_item_nm'];
    $price = $_POST['item_price_nm'];
    $category = $_POST['categories_nm'];
    $brand = $_POST['brands_nm'];
    $active = $_POST['active_nm'];
    $description = $_POST['item_description'];
    $picture = $_FILES['pic_nm'];

    //picture
    $tmp = $_FILES['pic_nm']['tmp_name'];
    $pathPicture = '../pictures/';
    $fileName = $_FILES['pic_nm']['name'];
    $timeName = time().$fileName;
    $path = $pathPicture.$timeName;
    //echo $path;
    $res = move_uploaded_file($tmp, $path);	

    //ALT
    $arrAlt = explode(".", $fileName);
    $num = count($arrAlt)-1;
    //echo $arrAlt[2];
    //echo $num;

    $alt="";
    for($i=0; $i<$num; $i++){
        $alt.=$arrAlt[$i]." ";
    }

    //var_dump($alt);


    //Regex back
    $regTitle = "/^[A-Z][a-z]{2,12}(\s[-])*(\s[A-Z][a-z]{2,12})*(\s[-])*(\s[-])*(\s[A-Z][a-z]{2,12})*$/";
    $regPrice = "/^[1-9][0-9]*$/";
    
    
    //Regex back test
    $errBack = [];
    if(!preg_match($regTitle, $title)){
        $errBack[] = "Invalid title format!";
    }
    if(!preg_match($regPrice, $price)){
        $errBack[] = "Invalid price!";
    }
    if($category == ""){
        $errBack[] = "Please choose category!";
    }
    if($brand == ""){
        $errBack[] = "Please choose brand!";
    }
    if($description == ""){
        $errBack[] = "Write description!";
    }
    



    //If there are no errors, entering in the database
    if(count($errBack) > 0){
        echo "Invalid entry";
    }
    else{
        $querry = "insert into products values(null, :title, :description, :price, :active, :brand, :category, default)";
        $statement = $connection -> prepare($querry);
        $statement -> bindParam(":title", $title);
        $statement -> bindParam(":description", $description);
        $statement -> bindParam(":price", $price);
        $statement -> bindParam(":active", $active);
        $statement -> bindParam(":brand", $brand);
        $statement -> bindParam(":category", $category);

    
        $result = $statement->execute() ? 201 : 500;
        //$message = "Successfully added new product!";
        $lastId = $connection -> lastInsertId();
    
        //var_dump($result);
    
        if($result){

            $querry2 = "INSERT INTO pictures VALUES(null, :href, :alt, :id_product)";
            $statement2 = $connection -> prepare($querry2);
            $statement2 -> bindParam(":href", $timeName);
            $statement2 -> bindParam(":alt", $alt);
            $statement2 -> bindParam(":id_product", $lastId);
    
            $result2 = $statement2->execute() ? 201 : 500;
            //$message2 = "Successfully added pic!";
    
            if($result2){
                header("Location: /PHP1/BabyRoller/admin.php");
            }
        }
        
        
        
    }

} else if(isset($_POST['idDelete'])){
    $id_product = $_POST['idDelete'];
    $querry = "DELETE FROM `products` WHERE id_product = :id_product";
    $statement = $connection -> prepare($querry);
    $statement -> bindParam(":id_product", $id_product);


    $result = $statement->execute() ? 201 : 500;
    $message = "Successfully deleted product!";

    //var_dump($result);

    if($result){
        http_response_code($result);
        header('Content-Type: application/json');
        echo json_encode(['message' => $message]);
    }
    else{
        echo "Product not found in database";
    }
}

else if(isset($_POST['sentUpdate'])){
    $id_product = $_POST['idUpdate'];

    $query = "SELECT * 
                FROM products INNER JOIN pictures ON products.id_product = pictures.id_product
                           INNER JOIN categories ON products.id_category = categories.id_category
                           INNER JOIN brand ON products.id_brand = brand.id_brand
                WHERE products.id_product = ?";
    

    $prepare = $connection->prepare($query);
    $prepare->bindParam(1, $id_product);
    $result = $prepare->execute();
    $res = $prepare->fetch();
    //var_dump($resFetch);
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($res);


    
}
else if(isset($_POST['update_item_btn'])){
    
    $id_product = $_POST['finalUpdateId'];
    //var_dump($_POST);
    //echo $id_product;

    $title = $_POST['add_item_nm'];
    $price = $_POST['item_price_nm'];
    $category = $_POST['categories_nm'];
    $brand = $_POST['brands_nm'];
    $active = $_POST['active_nm'];
    $description = $_POST['item_description'];
    $picture = $_FILES['update_pic_nm'];

    //picture
    $tmp = $_FILES['update_pic_nm']['tmp_name'];
    $pathPicture = '../pictures/';
    $fileName = $_FILES['update_pic_nm']['name'];
    $timeName = time().$fileName;
    $path = $pathPicture.$timeName;
    //echo $path;
    $res = move_uploaded_file($tmp, $path);	

    //ALT
    $arrAlt = explode(".", $fileName);
    $num = count($arrAlt)-1;
    //echo $arrAlt[2];
    //echo $num;

    $alt="";
    for($i=0; $i<$num; $i++){
        $alt.=$arrAlt[$i]." ";
    }

    //var_dump($alt);


    //Regex back
    $regTitle = "/^[A-Z][a-z]{2,12}(\s[-])*(\s[A-Z][a-z]{2,12})*(\s[-])*(\s[-])*(\s[A-Z][a-z]{2,12})*$/";
    $regPrice = "/^[1-9][0-9]*$/";
    
    
    //Regex back test
    $errBack = [];
    if(!preg_match($regTitle, $title)){
        $errBack[] = "Invalid title format!";
    }
    if(!preg_match($regPrice, $price)){
        $errBack[] = "Invalid price!";
    }
    if($category == ""){
        $errBack[] = "Please choose category!";
    }
    if($brand == ""){
        $errBack[] = "Please choose brand!";
    }
    if($description == ""){
        $errBack[] = "Write description!";
    }

    //Ako je sve ok upis u bazu
    if(count($errBack) > 0){
        echo "Invalid entry";
    }
     else{
        $querry = "UPDATE products 
                    SET product_name=:title, price=:price, description=:description, active=:active, id_category=:category, id_brand=:brand
                    WHERE id_product = :id_product";
        $statement = $connection -> prepare($querry);
        
        $statement -> bindParam(":title", $title);
        $statement -> bindParam(":description", $description);
        $statement -> bindParam(":price", $price);
        $statement -> bindParam(":active", $active);
        $statement -> bindParam(":brand", $brand);
        $statement -> bindParam(":category", $category);
        $statement -> bindParam(":id_product", $id_product);
        //var_dump($statement->execute());

        $result = $statement->execute() ? 201 : 500;
        //$message = "Successfully added new product!";
        $lastId = $connection -> lastInsertId();
    
        var_dump($result);
    
        if($result){

            $querry2 = "UPDATE pictures 
                        SET href = :href, alt = :alt
                        WHERE id_product = :id_product";
            $statement2 = $connection -> prepare($querry2);
            var_dump($statement2);
            $statement2 -> bindParam(":href", $timeName);
            $statement2 -> bindParam(":alt", $alt);
            $statement2 -> bindParam(":id_product", $id_product);
    
            $result2 = $statement2->execute() ? 201 : 500;
            //$message2 = "Successfully added pic!";
    
            if($result2){
                header("Location: /PHP1/BabyRoller/admin.php");
            }
        }
    }

}

?>