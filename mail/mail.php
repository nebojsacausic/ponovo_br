<?php
include "../views/connection.php";
session_start();

$name = $_POST{'message_name'};
$email = $_POST{'message_mail'};
//$subject = $_POST{'subject'};
$message = $_POST['message_text'];
$subject = "New message from site";

    $querry = "SELECT email FROM users WHERE role_id = 1";
    $ressult = $connection->query($querry);
    $resFetch = $ressult->fetch();
    $adminMail = $resFetch->email;
    
    //var_dump($adminMail);


$regName = '/^[A-Z][a-z]{2,24}(\s[A-Z][a-z]{2,24})+$/';
$regEmail = '/^(([a-z\d]+\.{1}){2}\d{1,3}\.\d{2}@ict.edu.rs)|(([a-z\d]+\.*)+@(gmail|hotmail|yahoo)\.com)$/';

$errBack = [];
    if(!preg_match($regName, $name)){
        $errBack[] = "Invalid name format!";
    }
    if(!preg_match($regEmail, $email)){
        $errBack[] = "Invalid email format";
    }
    if($message == ""){
        $errBack[] = "Type message.";
    }

    if(count($errBack) > 0){
        echo "Invalid entry";
    }
    else{
        $email_message = "

        Name: ".$name."
        Email: ".$email."
        Subject: ".$subject."
        Message: ".$message."
        ";

        mail ($adminMail , "New Message", $email_message);
        header("location: ../index.php");
    }



?>