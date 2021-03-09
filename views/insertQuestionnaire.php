<?php


if(isset($_POST['newQuestSent'])){
    
    include "connection.php";
    $newQuestion = $_POST['newQuestion'];
    $newArrAnswer = $_POST['newArrAnswer'];

    //var_dump($newQuestion);
    //var_dump($newArrAnswer);

    
    $query = "INSERT INTO questionnaire VALUES(null, :newQuestion, 0)";
    $statement = $connection -> prepare($query);
    $statement -> bindParam(":newQuestion", $newQuestion);

    $result = $statement->execute() ? 201 : 500;
    $lastId = $connection -> lastInsertId();
    
    
    
        if($result){

            foreach ($newArrAnswer as $question) {
                $query2 = "INSERT INTO response VALUES(null, :question ,:lastId)";
                $statement2 = $connection -> prepare($query2);
                $statement2 -> bindParam(":question", $question);
                $statement2 -> bindParam(":lastId", $lastId);
        
                $result2 = $statement2->execute() ? 201 : 500;
        
                
            }
            $message = "Successfully added questionnaire!";
            echo json_encode(["message" => $message]);
               

        }
        
        
        
    // }

}
else if(isset($_POST['chooseActive'])){
    
    include "connection.php";

    $query = "UPDATE questionnaire SET active = 0";
    $statement = $connection -> prepare($query);
    $result = $statement->execute() ? 201 : 500;

    if($result){
        try{
            $activeId = $_POST['activeId'];

            $query2 = "UPDATE questionnaire SET active = 1
                        WHERE id_questionnaire = ?";
            $statement2 = $connection -> prepare($query2);
            $statement2 -> bindParam(1, $activeId);
            
            //var_dump($statement2);
            $result2 = $statement2->execute() ? 201 : 500;
            if($result2){
                echo json_encode(["message" => "You have choose active questionnaire"]);
            }
        }
        catch(Exception $e){
            $e->getMessage();
        }
    }

}