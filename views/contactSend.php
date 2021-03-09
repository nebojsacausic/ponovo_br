<?php
    include "connection.php";
    session_start();

    if(isset($_POST['updMail'])){
        $id = $_SESSION['users']->user_id;
        //var_dump($id);
        $query = "SELECT email FROM users WHERE user_id = ?";
        
        $prepare = $connection->prepare($query);
        $prepare->bindParam(1, $id);
        $result = $prepare->execute();
        $res = $prepare->fetch();
        //var_dump($resFetch);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($res);
        
    }
    else if(isset($_POST['update_admin_email'])){
        $email = $_POST['email'];
        $idAdmin = $_SESSION['users']->user_id;
        //var_dump($idAdmin);

        $querry = "UPDATE users SET email=:email WHERE user_id = :idAdmin";
        $statement = $connection -> prepare($querry);
        $statement -> bindParam(":email", $email);
        $statement -> bindParam(":idAdmin", $idAdmin);
        
        $result = $statement->execute() ? 201 : 500;
        $message = "You have successfully updated your email!";
        //var_dump($result);

        if($result){
            http_response_code($result);
            header('Content-Type: application/json');
            echo json_encode(['message' => $message]);
        }
        
    }
?>