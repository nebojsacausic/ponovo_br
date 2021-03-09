<?php
session_start();
include "connection.php";

$userId = $_SESSION['users']->user_id;
$questionAnswer = $_POST['questionnaire_answer'];

// var_dump($userId);
// var_dump($questionAnswer);

try{
    $querry = "INSERT INTO user_response VALUES(null, :userId, :questionAnswer)";
    $statement = $connection -> prepare($querry);
    $statement -> bindParam(":userId", $userId);
    $statement -> bindParam(":questionAnswer", $questionAnswer);


    $result = $statement->execute() ? 201 : 500;
    $message = "Thank you";

    //var_dump($result);

    if($result){
        header("Location: ../questionnaire.php");
    }

}
catch(PDOException $ex){
    $res = "Error";
    $status = 500;
}