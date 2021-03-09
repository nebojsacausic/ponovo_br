<?php

    session_start();

if(isset($_POST['sent'])){

    $email = $_POST['email'];
    $pass = md5($_POST['pass']);

    //Regex back
    $regEmail = "/^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/";
    $regPass = "/^[\w\d\S]{8,30}$/";

    $errBack = [];
    //Regex back test
    if(!preg_match($regEmail, $email)){
        $errBack[] = "Invalid format of email!";
    }


    if(count($errBack) > 0){
        echo "Invalid entry";
    }
    else{

        include "connection.php";

        if($connection){
            $querry = "SELECT * FROM users WHERE email = :email AND pass = :pass";
            $statement = $connection -> prepare($querry);
            $statement -> bindParam(":email", $email);
            $statement -> bindParam(":pass", $pass);
            $result = $statement->execute();
            $message = "Successfull login!";
            //var_dump($statement);
            //var_dump($result);

            if($result){
                if($statement->rowCount() == 1){
                    $res = $statement->fetch();
                    //var_dump($res);

                    $_SESSION['users'] = $res;
                    if($_SESSION['users']){
                        //header("Location: admin.php");
                        http_response_code(200);
                        header('Content-Type: application/json');
                        echo json_encode(['message' => $message, $res]);
                    }
                    else{
                        echo "Dalje neces moci";
                    }
                }
            
            }
            else{
                echo "Error";
            }
        }
        else{
            echo "Connection problem";
        }
    }
    

    
}



?>