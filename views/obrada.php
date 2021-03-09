<?php

include "connection.php";

if(isset($_POST['sent'])){

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];

    //Regex back
    $regName = "/^[A-Z][a-z]{2,24}$/";
    $regEmail = "/^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/";
    $regAddress = "/^([A-Z][a-z]{3,25})(\s\d{0,4})?[A-Z]?$/";
    $regPass = "/^[\w\d\S]{8,30}$/";

    $errBack = [];
    //Regex back test
    if(!preg_match($regName, $fName)){
        $errBack[] = "Invalid format of first name!";
    }
    if(!preg_match($regName, $lName)){
        $errBack[] = "Invalid format of last name!";
    }
    if(!preg_match($regEmail, $email)){
        $errBack[] = "Invalid format of email!";
    }
    if(!preg_match($regAddress, $address)){
        $errBack[] = "Invalid format of address!";
    }
    if(!preg_match($regPass, $pass)){
        $errBack[] = "Invalid format of password!";
    }
    $pass = md5($pass);

    //If there are no errors, entering in the database
    if(count($errBack) > 0){
        echo "Invalid entry";
    }
    else{

        $querry = "insert into users values(null, :fName, :lName, :email, :address, :pass, 2)";
        $statement = $connection -> prepare($querry);
        $statement -> bindParam(":fName", $fName);
        $statement -> bindParam(":lName", $lName);
        $statement -> bindParam(":email", $email);
        $statement -> bindParam(":address", $address);
        $statement -> bindParam(":pass", $pass);


        $result = $statement->execute() ? 201 : 500;
        $message = "Successfully added user!";

        //var_dump($result);

        if($result){
            http_response_code($result);
            header('Content-Type: application/json');
            echo json_encode(['message' => $message]);
        }

    }
}



?>